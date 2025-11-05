<div class="createPopUp">
  <!-- Document Upload Popup -->
  <div id="documentPopup" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closeCreatePopup('documentPopup')">&times;</span>
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

  <!-- Upload Link Popup -->
  <div id="UploadPopup" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closeCreatePopup('UploadPopup')">&times;</span>
      <h2>Add Upload Link</h2>
      <form id="uploadLinkForm" onsubmit="return false;">
        <div class="form-group">
          <label for="linkName">Link Name:</label>
          <input type="text" id="linkName" name="linkName" required />
        </div>
        <div class="form-group">
          <label for="linkContentType">Content Type:</label>
          <select id="linkContentType" name="content_type" required>
            <option value="">Select type</option>
            <option value="note">Note</option>
            <option value="past_paper">Past Paper</option>
            <option value="model_paper">Model Paper</option>
            <option value="video_recording">Video Recording</option>
            <option value="external_link">External Link</option>
          </select>
        </div>
        <div class="form-group">
          <label for="linkDescription">Description:</label>
          <textarea id="linkDescription" name="linkDescription" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="linkPath">Link / File Path:</label>
          <input type="text" id="linkPath" name="content_path" placeholder="Enter URL or file path" required />
        </div>
        <div class="form-group">
          <label for="linkExpire">Expire Date:</label>
          <input type="date" id="linkExpire" name="linkExpire" />
        </div>
        <div class="form-group">
          <label>
            <input type="checkbox" id="linkHiddenCheckbox" /> Hidden from students until
          </label>
          <input type="date" id="linkHiddenUntil" name="linkHiddenUntil" disabled />
        </div>
        <div class="popup-buttons">
          <button type="submit" onclick="uploadLink()">Upload</button>
          <button type="button" onclick="closeCreatePopup('UploadPopup')">Cancel</button>
        </div>
      </form>
    </div>
  </div>
