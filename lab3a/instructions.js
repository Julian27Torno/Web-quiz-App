function checkboxValidation() {
   
    const checkBox = document.getElementById("checkbox");

    const startButton = document.getElementById("startQuiz")
  

    if (checkBox.checked == true){
      startButton.disabled = false;
    } else {
      startButton.disabled = true;
    }
  }