<div class="form-card">
  <div class="form-header">
    <h2>🎯 Intended Learners</h2>
  </div>

  <p class="form-description">
    The following descriptions will be publicly visible on your course landing page and will have a direct impact on your course performance. These descriptions will help learners decide if your course is right for them.
  </p>

  <form id="intended-learners-form">
    <!-- Learning Objectives -->
    <div class="form-group">
      <label class="form-label">What will students learn in your class?</label>
      <p class="form-help">
        You must enter at least 4 learning objectives or outcomes that learners can expect to achieve after completing your course.
      </p>

      <div class="input-group" id="objectives-container">
        <!-- Pre-filled objectives -->
        <input type="text" class="form-input" value="Understand the core principles of Physics" />
        <input type="text" class="form-input" value="Apply problem-solving techniques in real-world situations" />
        <input type="text" class="form-input" value="Analyze motion, energy, and forces effectively" />
        <input type="text" class="form-input" value="Build a strong foundation for advanced Physics topics" />
      </div>

      <span class="add-button" id="add-objective">+ Add more to your response</span>
    </div>

    <!-- Intended Learners -->
    <div class="form-group">
      <label class="form-label">Who is this class for?</label>
      <p class="form-help">
        Write a clear description of the <strong>intended learners</strong> for your course who will find your course content valuable.
      </p>
      <textarea class="form-textarea" id="intended-for">This course is designed for high school and college students who are new to Physics or want to strengthen their conceptual understanding.</textarea>
    </div>

    <!-- Prerequisites -->
    <div class="form-group">
      <label class="form-label">What are the requirements or prerequisites for taking your class?</label>
      <p class="form-help">
        List the required skills, experience, tools or equipment learners should have prior to taking your course. If there are no requirements, use this space to lower the barrier for beginners.
      </p>
      <textarea class="form-textarea" id="prerequisites">No prior Physics knowledge required. Basic understanding of Mathematics (algebra and geometry) will be helpful.</textarea>
    </div>

    <!-- Actions -->
    <div class="form-actions">
      <button type="button" class="btn-save-draft" id="btn-saveChange-intended">Save Changes</button>
      <button type="button" class="btn-next" id="btn_next-intended">Next <i class="fa-solid fa-chevron-right"></i></button>
    </div>
  </form>
</div>
<script src="../../../Public/assets/js/component/editClassIntendedLearners_individual.view.js"></script>