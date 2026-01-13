const button = document.getElementById("filterButton");
const menu = document.getElementById("dropdownMenu");

button.addEventListener("click", () => {
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});

menu.addEventListener("click", (e) => {
  e.preventDefault(); 
  if (e.target.tagName === "LI") {
    const sortOption = e.target.dataset.sort;
    button.textContent = e.target.textContent + " ▼";
    menu.style.display = "none";

    const url = new URL(window.location.href);

    url.searchParams.set("sort", sortOption);

    const searchInput = document.querySelector('input[name="query"]');
    if (searchInput && searchInput.value.trim() !== "") {
      url.searchParams.set("query", searchInput.value.trim());
    }

    // Reload page
    window.location.assign(url.toString());
  }
});

window.addEventListener("click", (e) => {
  if (!e.target.closest(".filter-dropdown")) menu.style.display = "none";
});
