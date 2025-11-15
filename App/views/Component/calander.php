
<div class="calendar-component">
    <div class="calendar-container">
        <div class="calendar-header">
            <button id="prev-month-btn">&lt;</button>
            <h2 id="current-month-year"></h2>
            <button id="next-month-btn">&gt;</button>
        </div>

        <div class="calendar-grid" id="calendar-grid">
            </div>
    </div>

    <div id="event-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h3>Add Event</h3>
            <form id="event-form" method="POST" action="<?php echo ROOT; ?>/StudentProfile/save_event" enctype="multipart/form-data">
                <input type="hidden" id="event-id" name="event_id">

                <input type="hidden" id="event-date" name="event_date" required>
                
                <label for="event-title">Event Title:</label>
                <input type="text" id="event-title" name="event_title" placeholder="Enter title" required>
                
                <label for="event-time">Time Slot:</label>
                <input type="time" id="event-time" name="event_time" required>
                
                <label for="event-description">Description:</label>
                <textarea id="event-description" name="event_description" placeholder="Add a short description" rows="3"></textarea>
        

                <div class="form-actions">
                    <button type="submit">Save</button>
                    <button type="button" id="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="event-tooltip" class="event-tooltip"></div>
<script>
let studentEvents = <?= json_encode($events ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
const appRoot = "<?php echo ROOT; ?>";
console.log("Loaded events:", studentEvents);
</script>


</body>
