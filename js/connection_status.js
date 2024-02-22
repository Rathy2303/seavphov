let status_txt = document.getElementById("status");
let alert_bar = document.getElementById("alert-js");
let connection_status = true;

setInterval(checkStatus,5000);
function checkStatus(){
    // if(connection_status){
    //     status_txt.innerHTML = "Your connection is back online";
    //     alert_bar.style.color = "Green";
    // }else{
    //     alert_bar.style.display = "block";
    //     status_txt.innerHTML = "Your connection is offline";
    //     alert_bar.style.color = "gray";
    // }
    if(!window.navigator.onLine){
        alert_bar.style.display = "flex";
        status_txt.innerHTML = "Your connection is offline";
        alert_bar.style.color = "gray";
    }else{
        status_txt.innerHTML = "Your connection is back online";
        alert_bar.style.color = "green";
        setTimeout(() => {
            alert_bar.style.display = "none";
        }, 3000);
    }
}