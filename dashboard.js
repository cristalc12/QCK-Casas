//sidebar functionality 

var sidebarOpen = false;
var sidebar = document.getElementById('sidebar');

function openSidebar () {
    if (!sidebarOpen) {
        sidebar.classList.add("sidebar-responsive");
        sidebarOpen = true;
    }
}

function closedSideBar () {
    if(sidebarOpen) {
        sidebar.classList.remove("sidebar-responsive"); 
        sidebarOpen = false;
    }
}

function showPropertyForm() {
    document.getElementById("property-form").style.display = "block";
}

function hidePropertyForm() {
    document.getElementById("property-form").style.display = "none";
}

// JavaScript function to handle form submission and add property card
document.getElementById("property-submit-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get form data
    const formData = new FormData(event.target);

    // Send the form data to the server using AJAX
    fetch("save_property.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Property saved successfully, add new property card
            addPropertyCard(data.property);
            hidePropertyForm();
        } else {
            alert(data.message); // Display error message if property not saved
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while saving the property.");
    });
});

// JavaScript function to add a new property card to the dashboard
function addPropertyCard(property) {
    const propertyCards = document.getElementById("property-cards");

    const cardDiv = document.createElement("div");
    cardDiv.classList.add("house-card");

    const imageDiv = document.createElement("div");
    const image = document.createElement("img");
    image.src = property.image_url;
    image.alt = property.title;
    imageDiv.appendChild(image);

    const detailsDiv = document.createElement("div");
    const titleHeading = document.createElement("h3");
    titleHeading.textContent = property.title;
    const descriptionP = document.createElement("p");
    descriptionP.textContent = property.description;
    const priceP = document.createElement("p");
    priceP.textContent = "Price: $" + property.price;

    detailsDiv.appendChild(titleHeading);
    detailsDiv.appendChild(descriptionP);
    detailsDiv.appendChild(priceP);

    cardDiv.appendChild(imageDiv);
    cardDiv.appendChild(detailsDiv);

    propertyCards.appendChild(cardDiv);
}

function goBack() {
    window.history.back();
}