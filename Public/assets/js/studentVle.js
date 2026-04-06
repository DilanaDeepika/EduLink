document.addEventListener("DOMContentLoaded", () => {

  /* ==============================
     TAB SWITCHING
  ============================== */
  const tabs = document.querySelectorAll(".tabs .tab");
  const panels = document.querySelectorAll(".panel");
  const indicator = document.querySelector(".tab-indicator");

  function updateIndicator(activeTab) {
    if (!activeTab || !indicator) return;
    const { left, width } = activeTab.getBoundingClientRect();
    const parentLeft = activeTab.parentElement.getBoundingClientRect().left;
    indicator.style.width = `${width}px`;
    indicator.style.left = `${left - parentLeft}px`;
  }

  const initialActiveTab = document.querySelector(".tabs .tab.active");
  if (initialActiveTab) updateIndicator(initialActiveTab);

  tabs.forEach(tab => {
    tab.addEventListener("click", e => {
      e.preventDefault();
      tabs.forEach(t => t.classList.remove("active"));
      panels.forEach(p => p.classList.remove("active"));
      tab.classList.add("active");
      const targetPanel = document.getElementById(tab.dataset.target);
      if (targetPanel) {
        targetPanel.classList.add("active");
      }
      updateIndicator(tab);
    });
  });

  /* ==============================
     ACCORDION
  ============================== */
  document.querySelectorAll(".section-header-button").forEach(button => {
    button.addEventListener("click", () => {
      button.classList.toggle("open");
      const body = button.nextElementSibling;
      if (body) body.classList.toggle("hidden");
    });
  });

  /* ==============================
     MODAL + FILE UPLOAD
  ============================== */
  const modal = document.getElementById("uploadModal");
  const fileInput = document.getElementById("fileInput");
  const fileList = document.getElementById("fileList");
  const assignmentIdField = document.getElementById("modalAssignmentId");
  const uploadForm = modal ? modal.querySelector("form") : null;
  const submitBtn = uploadForm ? uploadForm.querySelector("button[type='submit']") : null;

  let selectedFiles = [];

  // Open modal
  document.querySelectorAll(".open-upload-modal").forEach(btn => {
    btn.addEventListener("click", () => {
      if (assignmentIdField) {
        assignmentIdField.value = btn.dataset.assignmentId;
      }
      if (modal) {
        modal.classList.remove("hidden");
      }
    });
  });

  // Close modal
  if (modal) {
    const closeModalBtn = modal.querySelector(".close-modal");
    if (closeModalBtn) {
      closeModalBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
        resetModal();
      });
    }
  }

  function resetModal() {
    if (fileInput) fileInput.value = "";
    if (fileList) fileList.innerHTML = "";
    selectedFiles = [];
  }

  // File select
  if (fileInput) {
    fileInput.addEventListener("change", () => {
      selectedFiles = Array.from(fileInput.files);
      renderFiles();
    });
  }

  function renderFiles() {
    if (!fileList) return;
    fileList.innerHTML = "";
    selectedFiles.forEach((file, idx) => {
      const ext = file.name.split('.').pop();
      const nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");

      const li = document.createElement("li");
      li.innerHTML = `
        <input type="text" name="custom_names[]" value="${nameWithoutExt}" data-index="${idx}" class="rename-input" />
        .${ext}
        <button type="button" data-index="${idx}" class="remove-btn">&times;</button>
      `;
      fileList.appendChild(li);
    });
  }

  // Remove file from selection
  if (fileList) {
    fileList.addEventListener("click", e => {
      if (e.target.tagName === "BUTTON") {
        const index = e.target.dataset.index;
        selectedFiles.splice(index, 1);

        const dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));
        fileInput.files = dt.files;

        renderFiles();
      }
    });
  }

  // Submit form
  if (uploadForm) {
    uploadForm.addEventListener("submit", async e => {
      e.preventDefault();

      if (!selectedFiles.length) return;

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = "Uploading...";
      }

      const formData = new FormData();
      const assignmentId = assignmentIdField ? assignmentIdField.value : '';

      selectedFiles.forEach((file, index) => {
        formData.append("submission_files[]", file);

        const input = document.querySelector(`.rename-input[data-index="${index}"]`);
        formData.append("custom_names[]", input ? (input.value || file.name.replace(/\.[^/.]+$/, "")) : file.name.replace(/\.[^/.]+$/, ""));
      });

      formData.append("assignment_id", assignmentId);

      try {
        const res = await fetch(uploadForm.action, {
          method: "POST",
          body: formData
        });

        const result = await res.json();

        if (result.success) {
          const container = modal.querySelector(".submitted-files-container");
          if (container) {
            container.innerHTML = "";

            result.files.forEach(file => {
              const div = document.createElement("div");
              div.classList.add("submitted-file-card");
              div.dataset.fileId = file.submission_id;
              div.innerHTML = `
                <div class="file-info">
                  <div class="file-icon">📄</div>
                  <a href="${file.submission_path}" target="_blank" class="file-name">
                    ${file.filename}
                  </a>
                </div>
                <a href="${file.delete_url}" 
                   class="delete-file" 
                   data-file-id="${file.submission_id}">🗑️</a>
              `;
              container.appendChild(div);
            });
          }

          resetModal();
          modal.classList.add("hidden");

          // Update button text outside modal
          const assignmentBtn = document.querySelector(
            `.assignment-box button[data-assignment-id="${assignmentId}"]`
          );

          if (assignmentBtn) {
            assignmentBtn.classList.add("update-btn");
            assignmentBtn.textContent = "Update Submission";
          }
        }

      } catch (err) {
        console.error("Upload failed:", err);
      }

      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = "Submit";
      }
    });
  }

  /* ==============================
     DELETE FILE (AJAX)
  ============================== */
  document.addEventListener("click", async function(e) {
    const deleteLink = e.target.closest(".delete-file");
    if (!deleteLink) return;

    e.preventDefault();

    const fileCard = deleteLink.closest(".submitted-file-card");
    const container = deleteLink.closest(".submitted-files-container");

    // get assignment_id dynamically from the closest context
    const assignmentIdField = container ? container.closest(".upload-modal").querySelector("#modalAssignmentId") : null;
    const assignmentId = assignmentIdField ? assignmentIdField.value : null;

    try {
      const response = await fetch(deleteLink.href);
      const result = await response.json();

      if (result.success) {
        if (fileCard) fileCard.remove();

        // if no more files, update button outside modal
        if (container && container.querySelectorAll(".submitted-file-card").length === 0) {
          const assignmentBtn = document.querySelector(
            `.assignment-box button[data-assignment-id="${assignmentId}"]`
          );
          if (assignmentBtn) {
            assignmentBtn.classList.remove("update-btn");
            assignmentBtn.textContent = "Submit Assignment";
          }
        }
      }
    } catch (err) {
      console.error("Delete failed:", err);
    }
  });

  /* ==============================
     QUIZ MODAL
  ============================== */
/* ==============================
   QUIZ MODAL WITH TIMER
============================== */
const quizModal = document.getElementById("quizModal");

if (quizModal) {
    const closeBtn = quizModal.querySelector(".close-quiz-modal");
    const quizIdField = document.getElementById("quizId");
    const quizTitleField = document.getElementById("quizTitle");
    const questionContainer = document.getElementById("questionContainer");
    const prevBtn = document.getElementById("prevQuestion");
    const nextBtn = document.getElementById("nextQuestion");
    const submitBtn = document.getElementById("submitQuiz");
    const progressBar = document.getElementById("quizProgressBar");
    const timeRemainingElement = document.getElementById("timeRemaining");
    const quizTimerElement = document.getElementById("quizTimer");
    
    let currentQuiz = [];
    let currentQuizId = null;
    let currentIndex = 0;
    let answers = {};
    let quizDuration = 0; // in minutes
    let timeRemaining = 0; // in seconds
    let timerInterval = null;

    // ========================
    // START QUIZ
    // ========================
    document.querySelectorAll(".start-quiz-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const quizId = btn.dataset.quizId;
            const duration = parseInt(btn.dataset.duration) || 0;
            
            currentQuizId = quizId;
            quizDuration = duration;
            timeRemaining = duration * 60; // convert minutes to seconds
            
            if (quizIdField) quizIdField.value = quizId;
            
            // Set quiz title
            if (quizTitleField) {
                const quizCard = btn.closest('.quiz-card');
                const title = quizCard ? quizCard.querySelector('h4').textContent : 'Quiz';
                quizTitleField.textContent = title;
            }
            
            currentQuiz = window.quizData && window.quizData[quizId] ? window.quizData[quizId] : [];
            currentIndex = 0;
            answers = {};
            
            renderQuestion();
            startTimer();
            quizModal.classList.remove("hidden");
        });
    });

    // ========================
    // TIMER FUNCTIONS
    // ========================
    function startTimer() {
        if (timerInterval) clearInterval(timerInterval);
        
        updateTimerDisplay();
        
        timerInterval = setInterval(() => {
            timeRemaining--;
            updateTimerDisplay();
            
            // Warning at 2 minutes
            if (timeRemaining === 120) {
                if (quizTimerElement) quizTimerElement.classList.add('warning');
            }
            
            // Danger at 1 minute
            if (timeRemaining === 60) {
                if (quizTimerElement) {
                    quizTimerElement.classList.remove('warning');
                    quizTimerElement.classList.add('danger');
                }
            }
            
            // Time's up!
            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                handleTimeUp();
            }
        }, 1000);
    }
    
    function updateTimerDisplay() {
        if (!timeRemainingElement) return;
        
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timeRemainingElement.textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    
    function stopTimer() {
        if (timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
        }
    }
    
    function handleTimeUp() {
        if (questionContainer) {
            questionContainer.innerHTML = `
                <div class="quiz-feedback">
                  <h3>⏰ Time's Up!</h3>
                  <p style="color: #721c24; font-size: 1.1rem;">
                    The quiz time has expired. Your quiz will now close.
                  </p>
                </div>
            `;
        }
        
        // Disable all buttons
        if (prevBtn) prevBtn.disabled = true;
        if (nextBtn) nextBtn.disabled = true;
        if (submitBtn) submitBtn.classList.add("hidden");
        
        // Auto-close after 3 seconds
        setTimeout(() => {
            quizModal.classList.add("hidden");
            resetQuiz();
        }, 3000);
    }

    // ========================
    // CLOSE QUIZ MODAL
    // ========================
    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            if (confirm("Are you sure you want to exit the quiz? Your progress will be lost.")) {
                quizModal.classList.add("hidden");
                resetQuiz();
            }
        });
    }
    
    function resetQuiz() {
        stopTimer();
        if (questionContainer) questionContainer.innerHTML = "";
        if (quizTimerElement) {
            quizTimerElement.classList.remove('warning', 'danger');
        }
        currentQuiz = [];
        currentIndex = 0;
        answers = {};
        timeRemaining = 0;
    }

    // ========================
    // PREVIOUS BUTTON
    // ========================
    if (prevBtn) {
      prevBtn.addEventListener("click", () => {
        if (currentIndex > 0) {
          currentIndex--;
          renderQuestion();
        }
      });
    }

    // ========================
    // NEXT BUTTON
    // ========================
    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        if (currentIndex < currentQuiz.length - 1) {
          currentIndex++;
          renderQuestion();
        }
      });
    }

    // ========================
    // RENDER QUESTION FUNCTION
    // ========================
    function renderQuestion() {
        if (!currentQuiz.length || !questionContainer) return;

        const q = currentQuiz[currentIndex];

        let optionsHtml = "";
        q.options.forEach(opt => {
            const isChecked = answers[q.question_id] == opt.option_id ? "checked" : "";
            
            optionsHtml += `
              <li>
                <input type="radio" 
                       id="q${q.question_id}_opt${opt.option_id}" 
                       name="question_${q.question_id}" 
                       value="${opt.option_id}" 
                       ${isChecked} 
                       required>
                <label for="q${q.question_id}_opt${opt.option_id}">
                  ${opt.option_text}
                </label>
              </li>
            `;
        });

        questionContainer.innerHTML = `
            <div class="quiz-question">
              <p><strong>Question ${currentIndex + 1} of ${currentQuiz.length}:</strong>
              ${q.question_text}</p>
              <ul class="quiz-options">
                ${optionsHtml}
              </ul>
            </div>
        `;

        document.querySelectorAll(`input[name="question_${q.question_id}"]`).forEach(radio => {
            radio.addEventListener("change", e => {
                answers[q.question_id] = e.target.value;
            });
        });

        // Progress bar
        if (progressBar) {
            progressBar.style.width = ((currentIndex + 1) / currentQuiz.length * 100) + "%";
        }

        // Enable/disable buttons
        if (prevBtn) prevBtn.disabled = currentIndex === 0;
        if (nextBtn) nextBtn.disabled = currentIndex === currentQuiz.length - 1;
        if (submitBtn) {
            submitBtn.classList.toggle("hidden", currentIndex !== currentQuiz.length - 1);
        }
    }

    // ========================
    // SUBMIT QUIZ
    // ========================
    const quizForm = document.getElementById("quizForm");

    if (quizForm) {
        quizForm.addEventListener("submit", async e => {
            e.preventDefault();

            // Check if all questions are answered
            if (Object.keys(answers).length < currentQuiz.length) {
                alert("Please answer all questions before submitting");
                return;
            }

            stopTimer(); // Stop the timer

            const formData = new FormData();
            if (quizIdField) formData.append("quiz_id", quizIdField.value);
            
            const classIdInput = document.querySelector('input[name="class_id"]');
            if (classIdInput) formData.append("class_id", classIdInput.value);

            // Add all answers to formData
            Object.keys(answers).forEach(qid => {
                formData.append(`question_${qid}`, answers[qid]);
            });

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = "Submitting...";
            }

            try {
                const rootMeta = document.querySelector('meta[name="root"]');
                const ROOT = rootMeta ? rootMeta.content : '';
                
                const res = await fetch(`${ROOT}/StudentVle/submit_quiz`, { 
                    method: "POST", 
                    body: formData 
                });
                
                const result = await res.json();

                if (result.success) {
                    // Show score with detailed feedback
                    if (questionContainer) {
                        questionContainer.innerHTML = `
                            <div class="quiz-feedback">
                              <h3>🎉 Quiz Completed!</h3>
                              <p style="font-size: 1.2rem; margin: 15px 0;">
                                Your Score: <strong>${result.score}%</strong>
                              </p>
                              <p>
                                You answered <strong>${result.correct}</strong> out of <strong>${result.total}</strong> questions correctly.
                              </p>
                              <button type="button" class="close-feedback-btn"
                                style="
                                    display:inline-block;
                                    margin-top:15px;
                                    padding:8px 16px;
                                    background:#fed352;
                                    border:none;
                                    border-radius:6px;
                                    cursor:pointer;
                                    font-size:14px;
                                    font-weight:600;
                                    color:#1e2a5e;
                                ">
                                Close
                              </button>
                            </div>
                        `;
                        
                        // Add close functionality
                        questionContainer.querySelector('.close-feedback-btn').addEventListener('click', () => {
                            quizModal.classList.add("hidden");
                            resetQuiz();
                        });
                    }

                    // Disable all form elements
                    if (prevBtn) prevBtn.disabled = true;
                    if (nextBtn) nextBtn.disabled = true;
                    if (submitBtn) submitBtn.classList.add("hidden");

                } else {
                    alert(result.message || "Failed to submit quiz");
                    
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = "Submit Quiz";
                    }
                    startTimer(); // Restart timer if submission failed
                }

            } catch (err) {
                console.error(err);
                alert("Error submitting quiz. Please try again.");
                
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Submit Quiz";
                }
                startTimer(); // Restart timer if error occurred
            }
        });
    }
}




(function () {
  /* ── Wait until Chart.js is available ────────────────────── */
  function waitForChartJS(cb) {
    if (window.Chart) { cb(); return; }
    const s = document.createElement("script");
    s.src = "https://cdn.jsdelivr.net/npm/chart.js";
    s.onload = cb;
    document.head.appendChild(s);
  }

  /* ============================================================
     SAMPLE DATA
     Replace the objects below with PHP-injected JSON, e.g.:
       window.analysisData = <?= json_encode($analysisData) ?>;
     ============================================================ */
  const DATA = {
    /* your scores across all graded papers/quizzes, chronological */
    myScores: [
      { label: "Quiz 1",      type: "quiz",  score: 78 },
      { label: "Paper 1",     type: "paper", score: 65 },
      { label: "Quiz 2",      type: "quiz",  score: 84 },
      { label: "Paper 2",     type: "paper", score: 72 },
      { label: "Quiz 3",      type: "quiz",  score: 90 },
      { label: "Paper 3",     type: "paper", score: 58 },
      { label: "Quiz 4",      type: "quiz",  score: 76 },
    ],

    /* score-range buckets for the whole class (for the histogram)
       key = "0-9" | "10-19" | … | "90-100"
       value = number of students in that bucket               */
    classHistogram: {
      "0–9":   0,
      "10–19": 1,
      "20–29": 1,
      "30–39": 2,
      "40–49": 4,
      "50–59": 7,
      "60–69": 12,
      "70–79": 15,
      "80–89": 10,
      "90–100": 5,
    },

    /* your class rank (1 = best) out of total students */
    classRank: 8,
    totalStudents: 45,
  };

  /* ── Merge with server-side data if available ─────────────── */
  const d = Object.assign({}, DATA, window.analysisData || {});

  /* ============================================================
     HELPERS
  ============================================================ */
  const NAVY   = "#1e2a5e";
  const YELLOW = "#fed352";
  const MUTED  = "#9ca3af";

  function avg(arr) {
    if (!arr.length) return 0;
    return arr.reduce((s, v) => s + v, 0) / arr.length;
  }

  function hexAlpha(hex, alpha) {
    const r = parseInt(hex.slice(1,3),16);
    const g = parseInt(hex.slice(3,5),16);
    const b = parseInt(hex.slice(5,7),16);
    return `rgba(${r},${g},${b},${alpha})`;
  }

  /* ── shared Chart.js defaults ─────────────────────────────── */
  function baseOptions(extra = {}) {
    return Object.assign({
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: NAVY,
          titleColor: "#fff",
          bodyColor: "#fff",
          padding: 10,
          cornerRadius: 8,
        }
      },
      scales: {
        x: {
          grid: { color: "#f0f0f0" },
          ticks: { color: MUTED, font: { size: 11 } }
        },
        y: {
          grid: { color: "#f0f0f0" },
          ticks: { color: MUTED, font: { size: 11 } },
          beginAtZero: true,
        }
      }
    }, extra);
  }

  /* ============================================================
     KPI STRIP
  ============================================================ */
  function renderKPIs(scores) {
    const vals = scores.map(s => s.score);
    const overallAvg = vals.length ? Math.round(avg(vals)) : "—";
    const best  = vals.length ? Math.max(...vals) : "—";
    const worst = vals.length ? Math.min(...vals) : "—";
    const rank  = d.totalStudents
      ? `#${d.classRank} / ${d.totalStudents}`
      : "—";

    document.getElementById("kpiAvgVal").textContent   = overallAvg + (vals.length ? "%" : "");
    document.getElementById("kpiBestVal").textContent  = best  + (vals.length ? "%" : "");
    document.getElementById("kpiWorstVal").textContent = worst + (vals.length ? "%" : "");
    document.getElementById("kpiRankVal").textContent  = rank;
  }

  /* ============================================================
     HISTOGRAM
  ============================================================ */
  let histChart = null;

  function renderHistogram(scores) {
    /* bucket my scores */
    const myBuckets = {};
    Object.keys(d.classHistogram).forEach(k => myBuckets[k] = 0);
    scores.forEach(({ score }) => {
      const bucket = Math.min(Math.floor(score / 10), 9);
      const keys = Object.keys(myBuckets);
      if (keys[bucket]) myBuckets[keys[bucket]]++;
    });

    const labels  = Object.keys(d.classHistogram);
    const classCounts = Object.values(d.classHistogram);
    const myCounts    = Object.values(myBuckets);

    const ctx = document.getElementById("histogramChart");
    if (!ctx) return;

    if (histChart) histChart.destroy();

    histChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels,
        datasets: [
          {
            label: "Class",
            data: classCounts,
            backgroundColor: hexAlpha(NAVY, 0.18),
            borderColor: hexAlpha(NAVY, 0.5),
            borderWidth: 1.5,
            borderRadius: 4,
            order: 2,
          },
          {
            label: "You",
            data: myCounts,
            backgroundColor: hexAlpha(YELLOW, 0.85),
            borderColor: YELLOW,
            borderWidth: 2,
            borderRadius: 4,
            order: 1,
          }
        ]
      },
      options: baseOptions({
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: NAVY,
            callbacks: {
              title: items => `Score range: ${items[0].label}`,
              label: item => ` ${item.dataset.label}: ${item.raw} student${item.raw !== 1 ? "s" : ""}`,
            }
          }
        },
        scales: {
          x: { grid: { display: false }, ticks: { color: MUTED, font: { size: 11 } } },
          y: {
            grid: { color: "#f0f0f0" },
            ticks: { color: MUTED, font: { size: 11 }, stepSize: 2, precision: 0 },
            title: { display: true, text: "Students", color: MUTED, font: { size: 11 } }
          }
        }
      })
    });

    /* percentile banner */
    if (d.classRank && d.totalStudents) {
      const pct = Math.round((1 - (d.classRank - 1) / d.totalStudents) * 100);
      const banner = document.getElementById("percentileBanner");
      if (banner) {
        banner.textContent = `🎖️  You are in the top ${100 - pct + 1}% of your class (Rank #${d.classRank} of ${d.totalStudents})`;
        banner.classList.remove("hidden");
      }
    }
  }

  /* ============================================================
     ASSESSMENT TYPE BAR
  ============================================================ */
  let typeChart = null;

  function renderTypeChart(scores) {
    const groups = {};
    scores.forEach(({ type, score }) => {
      if (!groups[type]) groups[type] = [];
      groups[type].push(score);
    });

    const types  = Object.keys(groups);
    const avgs   = types.map(t => Math.round(avg(groups[t])));

    const PALETTE = [NAVY, YELLOW, "#4f89c8", "#f4845f", "#63b995"];

    const bgColors     = types.map((_, i) => hexAlpha(PALETTE[i % PALETTE.length], 0.85));
    const borderColors = types.map((_, i) => PALETTE[i % PALETTE.length]);

    const ctx = document.getElementById("typeChart");
    if (!ctx) return;
    if (typeChart) typeChart.destroy();

    typeChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: types.map(t => t.charAt(0).toUpperCase() + t.slice(1)),
        datasets: [{
          label: "Avg Score",
          data: avgs,
          backgroundColor: bgColors,
          borderColor: borderColors,
          borderWidth: 2,
          borderRadius: 6,
        }]
      },
      options: baseOptions({
        indexAxis: "y",
        plugins: {
          tooltip: {
            backgroundColor: NAVY,
            callbacks: {
              label: item => ` Avg: ${item.raw}%`
            }
          }
        },
        scales: {
          x: {
            max: 100,
            grid: { color: "#f0f0f0" },
            ticks: { color: MUTED, font: { size: 11 }, callback: v => v + "%" }
          },
          y: { grid: { display: false }, ticks: { color: MUTED, font: { size: 12, weight: "600" } } }
        }
      })
    });

    /* mini pills below chart */
    const summary = document.getElementById("typeSummary");
    if (summary) {
      summary.innerHTML = types.map((t, i) => `
        <div class="an-type-pill"
             style="background:${hexAlpha(PALETTE[i%PALETTE.length],.12)};
                    color:${PALETTE[i%PALETTE.length]};
                    border:1.5px solid ${hexAlpha(PALETTE[i%PALETTE.length],.3)}">
          ${t.charAt(0).toUpperCase()+t.slice(1)}: <strong>${avgs[i]}%</strong>
        </div>`).join("");
    }
  }

  /* ============================================================
     TREND LINE
  ============================================================ */
  let trendChart = null;

  function renderTrend(scores) {
    const labels = scores.map(s => s.label);
    const vals   = scores.map(s => s.score);

    const ctx = document.getElementById("trendChart");
    if (!ctx) return;
    if (trendChart) trendChart.destroy();

    trendChart = new Chart(ctx, {
      type: "line",
      data: {
        labels,
        datasets: [{
          label: "Score",
          data: vals,
          borderColor: NAVY,
          borderWidth: 2.5,
          pointBackgroundColor: vals.map((v, i) =>
            v === Math.max(...vals) ? YELLOW : NAVY
          ),
          pointRadius: 5,
          pointHoverRadius: 7,
          tension: 0.35,
          fill: {
            target: "origin",
            above: hexAlpha(NAVY, 0.06),
          }
        }]
      },
      options: baseOptions({
        plugins: {
          tooltip: {
            backgroundColor: NAVY,
            callbacks: {
              label: item => ` Score: ${item.raw}%`
            }
          }
        },
        scales: {
          x: { grid: { display: false }, ticks: { color: MUTED, font: { size: 11 } } },
          y: {
            min: 0, max: 100,
            grid: { color: "#f0f0f0" },
            ticks: { color: MUTED, font: { size: 11 }, callback: v => v + "%" }
          }
        }
      })
    });
  }

  /* ============================================================
     FILTER CHIPS
  ============================================================ */
  function renderAll(scores) {
    renderKPIs(scores);
    renderHistogram(scores);
    renderTypeChart(scores);
    renderTrend(scores);
  }

  document.getElementById("anFilterGroup")?.addEventListener("click", e => {
    const chip = e.target.closest(".an-chip");
    if (!chip) return;

    document.querySelectorAll(".an-chip").forEach(c => c.classList.remove("active"));
    chip.classList.add("active");

    const range = chip.dataset.range;
    const scores = range === "recent"
      ? d.myScores.slice(-5)
      : d.myScores;

    renderAll(scores);
  });

  /* ============================================================
     BOOT
  ============================================================ */
  waitForChartJS(() => {
    renderAll(d.myScores);

    /* Re-render when the Analysis tab becomes visible
       (charts need visible canvas to size correctly)         */
    document.querySelectorAll(".tabs .tab").forEach(tab => {
      tab.addEventListener("click", () => {
        if (tab.dataset.target === "analysis") {
          requestAnimationFrame(() => renderAll(
            document.querySelector(".an-chip.active")?.dataset.range === "recent"
              ? d.myScores.slice(-5)
              : d.myScores
          ));
        }
      });
    });
  });

})();

}); // END DOMContentLoaded