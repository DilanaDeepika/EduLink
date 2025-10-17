document.addEventListener("DOMContentLoaded", () => {
  const activeTab = document.querySelector(".tab.active");
  const indicator = document.querySelector(".tab-indicator");

  if (activeTab && indicator) {
    const { left, width } = activeTab.getBoundingClientRect();
    const parentLeft = activeTab.parentElement.getBoundingClientRect().left;
    indicator.style.width = `${width}px`;
    indicator.style.left = `${left - parentLeft}px`;
  }
});