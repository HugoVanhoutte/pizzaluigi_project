let days = document.getElementById('days');
let hours = document.getElementById('hours');
let minutes = document.getElementById('minutes');
let seconds = document.getElementById('seconds');


let countdown = function ()
{
    let release = new Date('2024-07-25T00:11:30');
    let today = Date.now()

    let totalS = Math.floor((release - today) / 1000)

    let nbD = Math.floor(totalS / (60*60*24));
    let nbH = Math.floor((totalS - (nbD*60*60*24)) / (60*60));
    let nbM = Math.floor((totalS - ((nbD*60*60*24) + (nbH*60*60))) / 60);
    let nbS = Math.floor(totalS - ((nbD*60*60*24) + (nbH*60*60) + (nbM*60)));

    days.textContent = nbD.toString();
    hours.textContent = nbH.toString();
    minutes.textContent = nbM.toString();
    seconds.textContent = nbS.toString();
}


setInterval("countdown()", 1000)

countdown();