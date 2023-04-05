function activeBtn(){
    let message = window.location.href;
    let substrings = message.split("/");
    let element = document.getElementById(substrings[substrings.length-1]);
    element.classList.remove("button");
    element.classList.add("activeBtn");
}
