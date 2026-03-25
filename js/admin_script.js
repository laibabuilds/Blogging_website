function checkScriptConnection() {
  console.log(" External JS file is connected!");
}
checkScriptConnection();
// document.addEventListener('DOMContentLoaded', function() {
//     const toggleSidebar = document.getElementById('toggleSidebar');
//     const adminSidebar = document.getElementById('adminSidebar');

//     if (toggleSidebar && adminSidebar) {
//         toggleSidebar.addEventListener('click', function() {
//             adminSidebar.classList.toggle('show');
//         });

//         // Close sidebar when clicking outside on mobile
//         document.addEventListener('click', function(event) {
//             if (window.innerWidth < 992 &&
//                 !adminSidebar.contains(event.target) &&
//                 !toggleSidebar.contains(event.target) &&
//                 adminSidebar.classList.contains('show')) {
//                 adminSidebar.classList.remove('show');
//             }
//         });
//     }
// });
// document.getElementById('toggleSidebar').onclick = function () {
//     document.getElementById('adminSidebar').classList.toggle('show');
// };
