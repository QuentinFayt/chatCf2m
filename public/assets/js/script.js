/*=========================Check and display if mail is correct for the user=========================*/
function checkMail() {
  let returnValue = "";
  let splitMail = document
    .querySelector("#mail")
    .value.toLowerCase()
    .split("@");
  if (splitMail[1] !== "cf2000.onmicrosoft.com") {
    returnValue = "Votre mail n'est pas un du CF2M!";
  } else {
    if (splitMail[0].split(".").length !== 2) {
      returnValue = "Votre mail n'est pas un du CF2M!";
    } else {
      returnValue = "Votre mail est correct";
    }
  }
  document.querySelector(".validation").style = "display:block;";
  document.querySelector(".validation").innerText = returnValue;
}
if (document.querySelector("#mail")) {
  document.querySelector("#mail").addEventListener("keyup", checkMail);
}
/*=========================Toggle login/Sign in forms=========================*/

function toggleInscription() {
  let login = document.querySelector(".login");
  let inscription = document.querySelector(".inscription");
  login.style.display = login.style.display === "none" ? "block" : "none";
  inscription.style.display =
    inscription.style.display === "none" ? "block" : "none";
}

document
  .querySelectorAll(".toggleForm")
  .forEach((el) => el.addEventListener("click", toggleInscription));

/*=========================Check if pwds matches=========================*/
function checkPasswords() {
  let password1 = document.querySelector("#mdp");
  let password2 = document.querySelector("#mdpConfirm");

  if (password1.value !== password2.value) {
    document.querySelector(".matches").style = "display:block;";
    document.querySelector(".matches").innerText =
      "Vos mots-de-passe ne correspondent pas!";
  } else {
    document.querySelector(".matches").style = "display:none;";
    document.querySelector(".matches").innerText = "";
  }
}
if (document.querySelector("#mdpConfirm")) {
  document
    .querySelector("#mdpConfirm")
    .addEventListener("change", checkPasswords);
}
if (document.querySelector(".send")) {
  document.querySelector(".send").addEventListener("click", function (e) {
    e.preventDefault();
    let data = {
      message: document.querySelector("#message").value,
    };
    $.post("assets/api/message.php", data);
    $("#message").val("");
  });
}
if (document.querySelector(".room")) {
  let lastId = null;
  $.get(
    "assets/api/loadMessages.php",
    function success(data) {
      if (data[0]) {
        lastId = data[data.length - 1].id;
      }
    },
    "JSON"
  );
  setInterval(function () {
    $.get(
      "assets/api/loadMessages.php",
      function success(data) {
        if (data[0]) {
          let insertMessage =
            '<div class="messages"><p><span class="name">' +
            data[data.length - 1].displayedName +
            "</span></p><p>" +
            data[data.length - 1].message +
            '</p><p><span class="date">' +
            data[data.length - 1].date +
            "</span></p></div>";
          if (lastId < data[data.length - 1].id) {
            lastId = data[data.length - 1].id;
            let divMessages = document.querySelectorAll(".messages");
            let ifNoMessage = document.querySelector(".room article");
            if (divMessages[0]) {
              divMessages[divMessages.length - 1].insertAdjacentHTML(
                "afterend",
                insertMessage
              );
            } else {
              ifNoMessage.insertAdjacentHTML("afterbegin", insertMessage);
            }
          }
        }
      },
      "JSON"
    );
  }, 500);
}
