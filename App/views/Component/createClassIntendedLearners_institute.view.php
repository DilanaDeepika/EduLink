<!-- Intended Learners -->
      
        <div class="form-card">
          <div class="form-header">
            <h2>🎯 Intended Learners</h2>
          </div>
          <p class="form-description">
            The following descriptions will be publicly visible on your course landing page and will have a direct impact on your course performance. These descriptions will help learners decide if your course is right for them.
          </p>

          <form>
            <div class="form-group">
              <label class="form-label">What will students learn in your class?</label>
              <p class="form-help">
                You must enter at least 4 learning objectives or outcomes that learners can expect to achieve after completing your course.
              </p>
              <div class="input-group" id="objectives-container">
                <input type="text" class="form-input" placeholder="Ex: Learn the fundamentals of Physics">
                <input type="text" class="form-input" placeholder="Objective ">
                <input type="text" class="form-input" placeholder="Objective ">
                <input type="text" class="form-input" placeholder="Objective ">
              </div>
              <span class="add-button" onclick="addObjective()">+ Add more to your response</span>
            </div>

            <div class="form-group">
              <label class="form-label">Who is this class for?</label>
              <p class="form-help">
                Write a clear description of the <strong>intended learners</strong> for your course who will find your course content valuable. This will help you attract the right learners to your course.
              </p>
              <textarea class="form-textarea"></textarea>
            </div>

            <div class="form-group">
              <label class="form-label">What are the requirements or prerequisites for taking your class?</label>
              <p class="form-help">
                List the required skills, experience, tools or equipment learners should have prior to taking your course. If there are no requirements, use this space to lower the barrier for beginners.
              </p>
              <textarea class="form-textarea"></textarea>
            </div>

            <div class="form-actions">
                <button type="button" class="btn-save-draft">Save as Draft</button>
                <button type="button" id="btn-next-intended"class="btn-next" onclick="">Next<i class="fa-solid fa-chevron-right"></i></button>

            </div>
          </form>
        </div>
        <script src="../../../Public/assets/js/component/createClassIntendedLearners_institute.view.js"></script>
