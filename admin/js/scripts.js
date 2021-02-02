tinymce.init({
  selector: "#richtextarea",
});

var userId = parseInt(window.location.href.split("=").pop());
var photoId;

if (document.querySelector(".modal_thumbnails"))
  document.querySelectorAll(".modal_thumbnails").forEach((img) => {
    img.onclick = function () {
      //enable apply button
      document.querySelector("#set_user_image").disabled = false;
      //storing clicked image id
      photoId = parseInt(this.dataset.id);
      //getting photo details
      fetch(`fetch_api.php?getPhotoDetails=true&photoId=${photoId}`)
        .then((response) => response.json())
        .then((content) => {
          const { filename, title, type, size, description } = content;
          document.querySelector("#modal_sidebar").innerHTML = `
        <h2 class="text-center">${
          filename.length > 15 ? filename.substr(0, 15) + "..." : filename
        }</h2>
        <p>Photo Title: ${title}</p>
        <p>Photo Type: ${type}</p>
        <p>Photo Size: ${size} bytes</p>
        <p>Description: ${description}</p>
        `;
        });
    };
  });

if (document.querySelector("#set_user_image"))
  document.querySelector("#set_user_image").onclick = function () {
    var formData = new FormData();
    formData.append("choosePhoto", "true");
    formData.append("userId", userId);
    formData.append("photoId", photoId);
    fetch("fetch_api.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((text) => {
        document.querySelector("#edit_user_photo").src = text;
      });
  };

//empty notifications
if (document.querySelector("#notifications"))
  document.querySelector("#notifications").onclick = function () {
    var formData = new FormData();
    formData.append("emptyNotifications", "true");
    fetch("fetch_api.php", {
      method: "POST",
      body: formData,
    });
    document.querySelector("#notificationsBadge").textContent = "0";
    document.querySelector("#notificationsBadge").style.backgroundColor =
      "#777777";
  };
