document.addEventListener('DOMContentLoaded', function() {
    var navbarToggler = document.getElementById('navbar-toggler');
    var navbarMenu = document.getElementById('navbarMenu');

    navbarToggler.addEventListener('click', function() {
        navbarMenu.classList.toggle('active');
    });
});


let slideIndex = 1;
showSlides(slideIndex);

function moveSlide(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("carousel-images")[0].getElementsByTagName("img");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}

document.getElementById('navbar-toggler').addEventListener('click', function() {
    var menu = document.getElementById('navbarMenu');
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
});


function validateForm() {
    var username = document.forms["loginForm"]["username"].value;
    var password = document.forms["loginForm"]["password"].value;
    if (username == "" || password == "") {
        alert("Username and Password must be filled out");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}




document.addEventListener('click', function(event) {
    var isClickInsideDropdown = document.querySelector('.dropdown').contains(event.target);

    if (!isClickInsideDropdown) {
        document.querySelector('.dropdown-menu').style.display = 'none';
    }
});

document.querySelector('.dropdown').addEventListener('click', function(event) {
    document.querySelector('.dropdown-menu').style.display = 'block';
    event.stopPropagation();
});


history.pushState(null, null, location.href);
  window.onpopstate = function () {
      history.go(1);
  };



  document.querySelectorAll('.product-image').forEach(item => {
    item.addEventListener('click', function() {
        var userId = this.getAttribute('data-user-id');
        var shopProductId = this.getAttribute('data-shop-product-id');

        // AJAX request to PHP
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'path_to_your_php_script.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('user_id=' + userId + '&shop_product_id=' + shopProductId);
    });
});


$(function(){
    $('#keywords').tablesorter(); 
  });



  document.addEventListener('DOMContentLoaded', function () {
    var navbarToggler = document.getElementById('navbar-toggler');
    var navbarMenu = document.getElementById('navbarMenu');

    navbarToggler.addEventListener('click', function () {
        console.log('Navbar toggler clicked!'); // Test if this line gets printed in the console
        navbarMenu.style.display = (navbarMenu.style.display === 'block' ? 'none' : 'block');
    });
});











// document.addEventListener('DOMContentLoaded', function() {
//     fetch('get_niches.php')
//       .then(response => response.json())
//       .then(data => {
//         const container = document.getElementById('niches-container');
//         data.forEach(niche => {
//           const div = document.createElement('div');
//           div.className = `niche ${niche.status.toLowerCase()}`;
//           div.textContent = niche.niche_number;
//           div.onclick = () => showNicheInfo(niche);
//           container.appendChild(div);
//         });
//       })
//       .catch(error => console.error('Error:', error));
//   });
  
//   function showNicheInfo(niche) {
//     const modal = document.getElementById('niche-info-modal');

//     modal.style.display = 'block';
//   }
  
document.addEventListener('DOMContentLoaded', (event) => {
    const boxes = document.querySelectorAll('.niche-box');
    const modal = document.getElementById('niche-info-modal');

    boxes.forEach(box => {
        box.addEventListener('click', function() {
            const nicheId = this.getAttribute('data-id');
            // Here you'd make an AJAX call to get the details of the niche by ID
            // For demonstration purposes, we'll just set some static content
            modal.innerHTML = `
                <h2>Niche Details (ID: ${nicheId})</h2>
                <p>Details about the niche...</p>
                <button onclick="closeModal()">Close</button>
            `;
            modal.style.display = 'block';
        });
    });
});

function closeModal() {
    document.getElementById('niche-info-modal').style.display = 'none';
}






document.addEventListener('DOMContentLoaded', function () {
    // Get all niche boxes into a NodeList
    var nicheBoxes = document.querySelectorAll('.niche-box');

    // Loop through each niche box and add a click event listener
    nicheBoxes.forEach(function (box) {
        box.addEventListener('click', function () {
            // Retrieve the id of the clicked niche
            var nicheId = this.dataset.id;

            // TODO: Fetch more data about the niche from the server using the nicheId
            // For demonstration purposes, we'll use static content

            // Get the modal element
            var modal = document.getElementById('niche-info-modal');

            // Set the content of the modal
            // You would replace this with actual content from your server
            modal.innerHTML = '<h3>Niche Details</h3>' +
                              '<p>ID: ' + nicheId + '</p>' +
                              '<p>More details here...</p>' +
                              '<button onclick="hideModal()">Close</button>';

            // Display the modal
            modal.style.display = 'block';
        });
    });
});

// Function to hide the modal
// function hideModal() {
//     var modal = document.getElementById('niche-info-modal');
//     modal.style.display = 'none';
// }


function handleClick(element) {
    var status = element.getAttribute('data-status');
    var id = element.getAttribute('data-id');
  
    if (status === 'available' || status === 'offered') {
      // Redirect to the next page with the niche ID
      window.location.href = 'nichevault.php?product_id=' + id;
    } else if (status === 'occupied' || status === 'owned') {
      // Display a message that it is not available
      alert('This niche is not available.');

    }
  }



