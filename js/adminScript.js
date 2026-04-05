
 function checkScriptConnection() {
  console.log(" External JS file is connected!");
}
checkScriptConnection();

document.addEventListener("DOMContentLoaded", function () {
  const toggleSidebar = document.getElementById("toggleSidebar");
  const adminSidebar = document.getElementById("adminSidebar");

  if (toggleSidebar && adminSidebar) {
    toggleSidebar.addEventListener("click", function () {
      adminSidebar.classList.toggle("show");
    });

    // Close sidebar when clicking outside on mobile
    // document.addEventListener('click', function(event) {
    //     if (window.innerWidth < 992 &&
    //         !adminSidebar.contains(event.target) &&
    //         !toggleSidebar.contains(event.target) &&
    //         adminSidebar.classList.contains('show')) {
    //         adminSidebar.classList.remove('show');
    //     }
    // });
  }
});
document.querySelectorAll(".btn-delete-confirm").forEach((btn) => {
  btn.addEventListener("click", function (e) {
    if (!confirm("Are you sure you want to delete this post?")) {
      e.preventDefault();
    }
  });
});
// Dount chart for dynamic data comming from database


document.addEventListener("DOMContentLoaded", function () {

  const canvas = document.getElementById("myChart");
  if (!canvas) return;

  const ctx = canvas.getContext("2d");

  // 🎨 gradients
  const gradientBlue = ctx.createLinearGradient(0, 0, 0, 200);
  gradientBlue.addColorStop(0, "#3b82f6");
  gradientBlue.addColorStop(1, "#1e3a8a");

  const gradientGreen = ctx.createLinearGradient(0, 0, 0, 200);
  gradientGreen.addColorStop(0, "#34d399");
  gradientGreen.addColorStop(1, "#065f46");

  const gradientAmber = ctx.createLinearGradient(0, 0, 0, 200);
  gradientAmber.addColorStop(0, "#fbbf24");
  gradientAmber.addColorStop(1, "#92400e");

  const gradientRed = ctx.createLinearGradient(0, 0, 0, 200);
  gradientRed.addColorStop(0, "#f87171");
  gradientRed.addColorStop(1, "#7f1d1d");

const gradientpink = ctx.createLinearGradient(0, 0, 0, 200);
  gradientpink.addColorStop(0, "#FFBF75");
  gradientpink.addColorStop(1, "#F9786C");

  // 🎯 center text
  const centerText = {
    id: "centerText",
    beforeDraw(chart) {
      const { width, height, ctx } = chart;
      ctx.save();

      const total =
        chartData.totalPosts +
        chartData.totalUsers +
        chartData.totalComments +
        chartData.totalLikes+
        chartData.totalAdmins;

      ctx.textAlign = "center";
      ctx.fillStyle = "#333";
      ctx.font = "bold 16px sans-serif";
      ctx.fillText("Total", width / 2, height / 2 - 10);

      ctx.font = "bold 20px sans-serif";
      ctx.fillText(total, width / 2, height / 2 + 15);

//       ctx.restore();
//       if (total === 0) {
//   ctx.fillText("No Data", width / 2, height / 2);
// }
    },
  };

  Chart.register(centerText);

  // ✅ CREATE CHART (ONLY ONCE)
  new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: ["Posts", "Users", "Comments", "Likes","Admins"],
      datasets: [{
        data: [
          chartData.totalPosts,
          chartData.totalUsers,
          chartData.totalComments,
          chartData.totalLikes,
          chartData.totalAdmins,
        ],
        backgroundColor: [
          gradientBlue,
          gradientGreen,
          gradientAmber,
          gradientRed,
          gradientpink,
        ],
        hoverOffset: 12,
      }],
    },
    options: {
      cutout: "70%",
      responsive: true,
      animation: {
        duration: 1500,
      },
      plugins: {
        legend: {
          position: "bottom",
        },
      },
    },
  });
  

});
// Dount chart for dummy data


//for dummy data
// document.addEventListener("DOMContentLoaded", function () {

//   const canvas = document.getElementById("myChart");
//   if (!canvas) return;

//   const ctx = canvas.getContext("2d");

//   // 🎯 Dummy data
//   const chartData = {
//     totalPosts: Math.floor(Math.random() * 20) + 5,
//     totalUsers: Math.floor(Math.random() * 15) + 3,
//     totalComments: Math.floor(Math.random() * 50) + 10,
//     totalLikes: Math.floor(Math.random() * 80) + 20,
//     totalAdmins:Math.floor(Math.random() * 20)+3,
//   };

//   // ✅ Safe fallback
//   const safeData = [
//     chartData.totalPosts || 1,
//     chartData.totalUsers || 1,
//     chartData.totalComments || 1,
//     chartData.totalLikes || 1,
//      chartData.totalAdmins || 1

//   ];

//   // 🎨 Gradients
//   const gradientBlue = ctx.createLinearGradient(0, 0, 0, 200);
//   gradientBlue.addColorStop(0, "#3b82f6");
//   gradientBlue.addColorStop(1, "#1e3a8a");

//   const gradientGreen = ctx.createLinearGradient(0, 0, 0, 200);
//   gradientGreen.addColorStop(0, "#34d399");
//   gradientGreen.addColorStop(1, "#065f46");

//   const gradientAmber = ctx.createLinearGradient(0, 0, 0, 200);
//   gradientAmber.addColorStop(0, "#fbbf24");
//   gradientAmber.addColorStop(1, "#92400e");

//   const gradientRed = ctx.createLinearGradient(0, 0, 0, 200);
//   gradientRed.addColorStop(0, "#f87171");
//   gradientRed.addColorStop(1, "#7f1d1d");

//   const gradientpink = ctx.createLinearGradient(0, 0, 0, 200);
//   gradientpink.addColorStop(0, "#FFBF75");
//   gradientpink.addColorStop(1, "#F9786C");


//   // 🎯 Center text plugin
//   const centerText = {
//     id: "centerText",
//     beforeDraw(chart) {
//       const { width, height, ctx } = chart;
//       ctx.save();

//       const total = safeData.reduce((a, b) => a + b, 0);

//       ctx.textAlign = "center";
//       ctx.fillStyle = "#333";
//       ctx.font = "bold 16px sans-serif";
//       ctx.fillText("Total", width / 2, height / 2 - 10);

//       ctx.font = "bold 20px sans-serif";
//       ctx.fillText(total, width / 2, height / 2 + 15);

//       ctx.restore(); 
//     },
//   };

//   Chart.register(centerText);

//   // ✅ Chart
//   new Chart(ctx, {
//     type: "doughnut",
//     data: {
//       labels: ["Posts", "Users", "Comments", "Likes","Admins"],
//       datasets: [{
//         data: safeData, // ✅ FIXED
//         backgroundColor: [
//           gradientBlue,
//           gradientGreen,
//           gradientAmber,
//           gradientRed,
//           gradientpink
//         ],
//         hoverOffset: 12,
//       }],
//     },
//     options: {
//       cutout: "70%",
//       responsive: true,
//       animation: {
//         duration: 1500,
//       },
//       plugins: {
//         legend: {
//           position: "bottom",
//         },
//       },
//     },
//   });

// });