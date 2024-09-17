   // Toggle visibility of Services dropdown
   const servicesToggle = document.getElementById('servicesToggle');
   const servicesDropdown = document.getElementById('servicesDropdown');
   let isServicesOpen = false;

   servicesToggle.addEventListener('click', function() {
       isServicesOpen = !isServicesOpen;
       servicesDropdown.style.display = isServicesOpen ? 'block' : 'none';
   });

   // Toggle visibility of Account dropdown
   const accountToggle = document.getElementById('accountToggle');
   const accountDropdown = document.getElementById('accountDropdown');
   let isAccountOpen = false;

   accountToggle.addEventListener('click', function() {
       isAccountOpen = !isAccountOpen;
       accountDropdown.style.display = isAccountOpen ? 'block' : 'none';
   });

   // Close dropdowns when clicking outside
   document.addEventListener('click', function(e) {
       if (!servicesToggle.contains(e.target) && !servicesDropdown.contains(e.target)) {
           servicesDropdown.style.display = 'none';
           isServicesOpen = false;
       }

       if (!accountToggle.contains(e.target) && !accountDropdown.contains(e.target)) {
           accountDropdown.style.display = 'none';
           isAccountOpen = false;
       }
   });