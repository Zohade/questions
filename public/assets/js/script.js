const endTime = new Date(new Date().getTime() + 10 * 60 * 1000);
const form = document.getElementById("quizForm");
let soundPlayed = false;
let lastBeepTime = 0;
const timer = setInterval(() => {
    const now = new Date();
    const difference = endTime - now;

    if (difference <= 0) {
        clearInterval(timer);
        document.getElementById("minutes").innerText = "00 :";
        document.getElementById("secondes").innerText = "0";
        form.submit();
        return;
    } else if (difference <= 2 * 60 * 1000) {
        document.getElementById("minutes").style.color = "red";
        document.getElementById("secondes").style.color = "red";
        document.getElementById("minutes").classList.add("clignotant");
        document.getElementById("secondes").classList.add("clignotant");
        if (!soundPlayed) {
            const nowTime = Date.now();
            if (nowTime - lastBeepTime > 10000) {
                document.getElementById("alertSound").play();
                lastBeepTime = nowTime;
            }
        }
    }

    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
    const secondes = Math.floor((difference % (1000 * 60)) / 1000);
    document.getElementById("minutes").innerText = "0" + minutes + " :";
    document.getElementById("secondes").innerText = secondes;
    if (secondes < 10) {
        document.getElementById("secondes").innerText = "0" + secondes;
    }
}, 1000);
