<body>
  <div class="calendar-container">
    <h2>My Calendar</h2>

    <!-- view toggle -->
    <div class="view-toggle">
      <button id="btnMonth">Month</button>
      <button id="btnWeek">Week</button>
    </div>

    <!-- navigation -->
    <div class="calendar-header">
      <div class="nav-left">
        <button id="prevBtn">&#8592;</button>
        <button id="nextBtn">&#8594;</button>
        <button id="todayBtn">Today</button>
      </div>
      <div id="date-range" class="range-label"></div>
      <div class="nav-right"></div>
    </div>

    <!-- calendar body -->
    <div id="calendar" class="calendar-body"></div>
  </div>

  <!-- modal -->
  <div id="eventModal" class="modal">
    <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>
      <h2>Create Event</h2>
      <form id="eventForm">
        <label
          >Title:
          <input
            type="text"
            id="eventTitle"
            placeholder="Event title"
            required
          />
        </label>
        <label
          >Description:
          <textarea
            id="eventDesc"
            placeholder="Add description..."
            rows="3"
          ></textarea>
        </label>
        <div class="date-time-row">
          <label
            >Date:
            <input type="date" id="eventDate" required />
          </label>
          <label
            >Start Time:
            <input type="time" id="eventStart" required />
          </label>
          <label
            >End Time:
            <input type="time" id="eventEnd" required />
          </label>
        </div>
        <label
          >Color:
          <input type="color" id="eventColor" value="#FED352" />
        </label>
        <div class="form-actions">
          <button type="submit">Save</button>
          <button type="button" id="cancelEvent">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</body>
