<div class="createPopUp">

  <div id="documentPopup" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closeAllPopups()">&times;</span>
      <h2>Create Document</h2>
      <form id="classContentForm" method="POST" action="<?php echo ROOT; ?>/TeacherVle/uploadDocument" enctype="multipart/form-data">
        <div class="form-group">
          <input type="hidden" name="class_id" value="<?= htmlspecialchars($data['class']->class_id) ?>">
          <input type="hidden" name="content_id" id="content_id_input">
          <label for="docName">Document Name:</label>
          <input type="text" id="docName" name="docName" required />
        </div>
        <div class="form-group">
          <label for="docDescription">Description:</label>
          <textarea id="docDescription" name="docDescription" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="docUpload">Upload File:</label>
          <input type="file" id="docUpload" name="docUpload" accept=".pdf,.docx,.pptx,.txt" required />
        </div>
        <div class="form-group">
          <label for="docContentType">Content Type:</label>
          <select id="docContentType" name="linkType" required>
            <option value="">Select type</option>
            <option value="note">Note</option>
            <option value="past_paper">Past Paper</option>
            <option value="model_paper">Model Paper</option>
            <option value="video_recording">Video Recording</option>
            <option value="external_link">External Link</option>
          </select>
        </div>
        <input type="hidden" id="docContentPath" name="content_path" />
        <div class="form-group">
          <label for="docExpire">Expire Date:</label>
          <input type="date" id="docExpire" name="docExpire" />
        </div>
        <div class="form-group">
          <label for="docHiddenUntil">Hidden for students until:</label>
          <input type="date" id="docHiddenUntil" name="docHiddenUntil" />
        </div>
        <div class="popup-buttons">
          <button type="submit" onclick="uploadDocument()">Upload</button>
          <button type="button" onclick="closeCreatePopup('documentPopup')">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div id="UploadPopup" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closeAllPopups()">&times;</span>
      <h2>Create Student Submission Link</h2>
      
      <form id="uploadLinkForm" method="POST" action="<?php echo ROOT; ?>/TeacherVle/uploadLink">
        <input type="hidden" name="class_id" value="<?= htmlspecialchars($data['class']->class_id) ?>">
        <input type="hidden" name="linkType" value="assignment">
        <input type="hidden" name="content_path" value="student_submission_link">

        <div class="form-group">
          <label for="assignName">Activity Name:</label>
          <input type="text" id="assignName" name="docName" required placeholder="e.g. Assignment 1 Submission" />
        </div>

        <div class="form-group">
          <label for="assignDescription">Instructions for Students:</label>
          <textarea id="assignDescription" name="docDescription" rows="4" placeholder="e.g. Please upload your final answer as a PDF or Zip file."></textarea>
        </div>
        
        <div style="margin-bottom: 15px; font-size: 0.9em; color: #666; background: #f8f9fa; padding: 10px; border-radius: 4px;">
          <i class="fa fa-info-circle"></i> 
          Students will be allowed to upload: <strong>PDF, Word, PNG, ZIP</strong>
        </div>

        <div class="form-group">
          <label for="assignDue">Due Date (Deadline):</label>
          <input type="datetime-local" id="assignDue" name="docExpire" required />
        </div>

        <div class="popup-buttons">
          <button type="submit">Create Submission Link</button>
          <button type="button" onclick="closeAllPopups()">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div id="quizPopup" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closeAllPopups()">&times;</span>
      <h2>Create New Quiz</h2>
      
      <form id="quizForm" method="POST" action="<?php echo ROOT; ?>/TeacherVle/createQuiz">
        <input type="hidden" name="class_id" value="<?= htmlspecialchars($data['class']->class_id) ?>">

        <div class="form-group">
          <label for="quizName">Quiz Title:</label>
          <input type="text" id="quizName" name="docName" required placeholder="e.g. Unit 1: Introduction Quiz" />
        </div>

        <div class="form-group">
          <label for="quizDescription">Instructions:</label>
          <textarea id="quizDescription" name="docDescription" rows="3" placeholder="e.g. You have 20 minutes to answer 10 questions."></textarea>
        </div>

        <div class="form-group">
          <label for="quizDuration">Duration (Minutes):</label>
          <input type="number" id="quizDuration" name="duration" min="5" placeholder="e.g. 30" />
        </div>

        <div class="popup-buttons">
          <button type="submit">Create & Add Questions ➝</button>
          <button type="button" onclick="closeAllPopups()">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div id="importMarksPopup" class="popup">
    <div class="popup-content import-popup-content">
      <span class="close" onclick="closeImportPopup()">&times;</span>
      <h2>Import Marks</h2>
      <p id="popupPaperTitle" class="popup-subtitle"></p>
      
      <form id="importMarksForm" method="POST" action="<?php echo ROOT; ?>/TeacherVle/uploadGrades" enctype="multipart/form-data">
        <input type="hidden" name="class_id" value="<?= htmlspecialchars($data['class']->class_id ?? $data['class_id']) ?>">
        <input type="hidden" name="paper_id" id="popupPaperId">

        <div class="import-step-box">
            <h4>Step 1: Download Template</h4>
            <p>Download the student list for this specific paper.</p>
            <a id="templateDownloadLink" href="#" class="download-link-btn">
                <i class="fa fa-download"></i> Download CSV
            </a>
        </div>

        <div class="import-step-box">
            <h4>Step 2: Upload Filled File</h4>
            <p>Fill in the "Marks" column and upload here.</p>
            <div class="form-group">
                <input type="file" name="gradeFile" accept=".csv" required class="file-input" />
            </div>
        </div>

        <div class="popup-buttons">
            <button type="submit" class="save-btn">Upload & Save Marks</button>
            <button type="button" onclick="closeImportPopup()" class="cancel-btn">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div id="addPaperPopup" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closeAddPaperPopup()">&times;</span>
      <h2>Add New Assessment Paper</h2>
      
      <form method="POST" action="<?= ROOT ?>/TeacherVle/addPaper">
        <input type="hidden" name="class_id" value="<?= htmlspecialchars($data['class']->class_id) ?>">

        <div class="form-group">
          <label for="paperTitle">Paper Name / Title:</label>
          <input type="text" id="paperTitle" name="paper_title" required placeholder="e.g. Term 1 Mathematics" />
        </div>

        <div class="popup-buttons">
          <button type="submit">Create Paper</button>
          <button type="button" onclick="closeAddPaperPopup()">Cancel</button>
        </div>
      </form>
    </div>
  </div>

</div>