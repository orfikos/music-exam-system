document.addEventListener("DOMContentLoaded", function () {
    const timerElement = document.getElementById("timer");
    const examForm = document.getElementById("examForm");

    if (!timerElement || !examForm) return;

    const endTime = parseInt(timerElement.dataset.endTime, 10);

    function updateTimer() {
        const now = Math.floor(Date.now() / 1000);
        const remaining = endTime - now;

        if (remaining <= 0) {
            timerElement.textContent = "Time is up!";
            examForm.submit();
            return;
        }

        const minutes = Math.floor(remaining / 60);
        const seconds = remaining % 60;

        timerElement.textContent =
            `Time Left: ${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
    }

    updateTimer();
    setInterval(updateTimer, 1000);
});