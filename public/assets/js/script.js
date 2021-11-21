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
document.querySelector("#mail").addEventListener("keyup", checkMail);

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
  }
}
document
  .querySelector("#mdpConfirm")
  .addEventListener("change", checkPasswords);
