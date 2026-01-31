
// HAMBURGER 
const hamburger = document.getElementById("hamburger");
const navMenu = document.getElementById("navbarMenu");

hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
});


// ROOMS SLIDESHOW
const grid = document.getElementById("roomsGrid");
const prevBtn = document.querySelector(".prev-btn");
const nextBtn = document.querySelector(".next-btn");

function getCardWidth() {
    const card = grid.querySelector(".room-card");
    const style = window.getComputedStyle(card);
    const marginRight = parseInt(style.marginRight) || 20;
    return card.offsetWidth + marginRight;
}

function nextRoom() {
    const scrollAmount = getCardWidth();
    grid.scrollBy({ left: scrollAmount, behavior: "smooth" });
}

function prevRoom() {
    const scrollAmount = getCardWidth();
    grid.scrollBy({ left: -scrollAmount, behavior: "smooth" });
}

function updateButtons() {
    prevBtn.disabled = grid.scrollLeft === 0;
    nextBtn.disabled = grid.scrollLeft + grid.clientWidth >= grid.scrollWidth;
}

grid.addEventListener("scroll", updateButtons);

updateButtons();


// ROOM BOOKING FORM
function openModal(roomName, roomPrice) {
    document.getElementById("modalRoomName").textContent = `Booking: ${roomName}`;
    document.getElementById("bookModal").style.display = "block";
}

function closeModal() {
    document.getElementById("bookModal").style.display = "none";
}

function submitBooking(event) {
    event.preventDefault();
    const form = event.target;
    const name = form.name.value;
    const email = form.email.value;
    const date = form.date.value;
    const room = document.getElementById("modalRoomName").textContent.replace('Book: ', '');

    alert(`Booking submitted!\nRoom: ${room}\nName: ${name}\nEmail: ${email}\nDate: ${date}`);
    form.reset();
    closeModal();
}

window.onload = renderRooms;


