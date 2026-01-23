

// HAMBURGER 
const hamburger = document.getElementById("hamburger");
const navMenu = document.getElementById("navbarMenu");

hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
});

// ROOMS SLIDESHOW
let currentIndex = 0;
const visibleCards = 3;

const rooms = [
    {
        name: "Deluxe Room",
        desc: "Elegantly appointed room with city views and modern amenities",
        guests: "2 Guests",
        size: "350 sq ft",
        price: "$199",
        rating: "4.8",
        img: "./assets/images/room-deluxe.jpeg"
    },
    {
        name: "Executive Suite",
        desc: "Spacious suite with separate living area and premium features",
        guests: "3 Guests",
        size: "600 sq ft",
        price: "$349",
        rating: "4.9",
        img: "./assets/images/suite-executive.jpeg"
    },
    {
        name: "Presidential Suite",
        desc: "Luxurious suite with panoramic views and butler service",
        guests: "4+ Guests",
        size: "1200 sq ft",
        price: "$599",
        rating: "5.0",
        img: "./assets/images/suite-presidential.jpeg"
    },
    {
        name: "Superior Room",
        desc: "Comfortable room with modern furnishings and garden views",
        guests: "2 Guests",
        size: "320 sq ft",
        price: "$159",
        rating: "4.6",
        img: "./assets/images/room-superior.jpg"
    },
    {
        name: "Family Suite",
        desc: "Spacious suite ideal for families with separate sleeping area",
        guests: "4 Guests",
        size: "750 sq ft",
        price: "$279",
        rating: "4.7",
        img: "./assets/images/suite-family.jpg"
    },
    {
        name: "Junior Suite",
        desc: "Stylish open-plan suite with seating area and premium comfort",
        guests: "2 Guests",
        size: "480 sq ft",
        price: "$229",
        rating: "4.5",
        img: "./assets/images/suite-junior.jpg"
    },
    {
        name: "Ocean View Room",
        desc: "Bright room featuring stunning ocean views and private balcony",
        guests: "2 Guests",
        size: "360 sq ft",
        price: "$249",
        rating: "4.8",
        img: "./assets/images/room-oceanView.jpg"
    },
    {
        name: "Economy Room",
        desc: "Practical and affordable room offering essential comforts",
        guests: "1–2 Guests",
        size: "260 sq ft",
        price: "$129",
        rating: "4.3",
        img: "./assets/images/room-economy.jpg"
    }
];

function renderRooms() {
    const grid = document.getElementById("roomsGrid");
    grid.innerHTML = "";

    for (let i = 0; i < visibleCards; i++) {
        const index = (currentIndex + i) % rooms.length;
        const room = rooms[index];

        grid.innerHTML += `
      <div class="room-card">
        <div class="room-image">
          ${room.img
                ? `<img src="${room.img}">`
                : ``
            }
          ${room.rating
                ? `<div class="room-rating">
                  <span class="star">★</span>
                  <span>${room.rating}</span>
                </div>`
                : ``
            }
        </div>

        <div class="room-content">
          <h3>${room.name || ""}</h3>
          <p>${room.desc || ""}</p>

          <div class="room-specs">
            <span>${room.guests || ""}</span>
            <span>${room.size || ""}</span>
          </div>

          <div class="room-footer">
            <div class="room-price">
              <span class="price">${room.price || ""}</span>
              <span class="period">${room.price ? "/night" : ""}</span>
            </div>
            ${room.name ? `<button class="btn btn-red"  onclick="openModal('${room.name}','${room.price}')">Book Now</button>` : ``}
          </div>
        </div>
      </div>
    `;
    }
}

function nextRoom() {
    currentIndex = (currentIndex + 1) % rooms.length;
    renderRooms();
}

function prevRoom() {
    currentIndex--;
    if (currentIndex < 0) {
        currentIndex = rooms.length - 1;
    }
    renderRooms();
}

window.onload = renderRooms;


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


