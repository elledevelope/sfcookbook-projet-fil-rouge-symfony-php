//  ------------------------ Toggle Menu :

      const burgerIcon = document.querySelector('.burger');
      const closeIcon = document.querySelector('.close-x');
      const menu = document.querySelector('.nav-links');
  

      // click event burger icon      
      burgerIcon.addEventListener('click', function () {
        menu.style.display = 'block';
      });
  
      // click event close-x icon
      closeIcon.addEventListener('click', function () {
        menu.style.display = 'none';
      });

  
  
//   const navLinks = document.getElementById("navLinks");
    
//   function showMenu(){
//       navLinks.style.right = "0";
//   }

//   function hideMenu(){
//       navLinks.style.right = "-200px";
//   }



// ---------------Scroll nav:

    // const nav = document.querySelector('nav');
    // const navLinks = document.querySelectorAll('.nav-links ul li');

    // function handleScroll() {
    //     // Add or remove the 'scrolled' class based on scroll position
    //     if (window.scrollY > 0) {
    //         nav.classList.add('scrolled');
    //     } else {
    //         nav.classList.remove('scrolled');
    //     }

    //     // Add or remove the 'active' class based on scroll position
    //     navLinks.forEach(link => {
    //         const sectionId = link.querySelector('a').getAttribute('href').substring(1);
    //         const section = document.getElementById(sectionId);
    //         const rect = section.getBoundingClientRect();

    //         if (rect.top <= 0 && rect.bottom > 0) {
    //             link.classList.add('active');
    //         } else {
    //             link.classList.remove('active');
    //         }
    //     });
    // }

    // // Add scroll event listener
    // window.addEventListener('scroll', handleScroll);
