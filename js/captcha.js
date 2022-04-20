let temp_src = [];
let temp_id = [];
let result_images = [];
let verify_images = [];
let compteurForCaptcha = 0;
let submit = document.getElementById("submit");
let p = document.getElementById("captcha-message");
let captchaBtn = document.getElementById("captcha-btn");
let validateCaptcha = document.getElementById("validate-captcha");
validateCaptcha.innerHTML = "";
submit.style.display = "none";
function randomImg() {
    let tabid = [];
    for (let i = 1; i <= 9; i++) {
        tabid.push(i);
    }
    tabid.sort(() => Math.random() - 0.5);
    let img;
    let j = 0;
    for (let i = 1; i <= 9; i++) {
        img = document.getElementById(i);
        let idImg = img.id;
        idImg = tabid[j];
        j++;
        img.id = idImg;
    }

    for (let i = 1; i <= 9; i++) {
        img = document.getElementById(i);
        let srcImg = img.src;
        srcImg = tabid[j];
        j++;
        img.src = "images/captcha/minion/" + img.id + ".jpg";
    }

}
function verifCaptcha(){
    let count = 0;
    let j = 1;
    let children = document.getElementById("puzzle").children;
    for (let i = 0; i < 9; i++) {
        let img = children[i];
        if (parseInt(img.id) === j) {
            count++;
        }
        j++;

    }
    if (count === 9) {
        return true;
    }
}

function changeImage(src_image, id_image) {
    compteurForCaptcha++;

    temp_src.push(src_image);
    temp_id.push(id_image);
    document.getElementById(id_image).style.border = "2px solid #17760A";

    if (compteurForCaptcha % 2 === 0) {
        let temp_src_1 = temp_src[0];
        let temp_id_1 = temp_id[0];
        let temp_src_2 = temp_src[1];
        let temp_id_2 = temp_id[1];

        temp_src[0] = temp_src_2;
        temp_id[0] = temp_id_2;
        temp_src[1] = temp_src_1;
        temp_id[1] = temp_id_1;

        result_images.push(id_image);
        verify_images.push(temp_id[0]);

        let image_1 = document.getElementById(temp_id[0]);
        let image_2 = document.getElementById(temp_id[1]);
        image_1.src = temp_src[1];
        image_1.id = temp_id[1];
        image_2.src = temp_src[0];
        image_2.id = temp_id[0];
        document.getElementById(temp_id[0]).style.border = "none";
        document.getElementById(temp_id[1]).style.border = "none";
        temp_src = [];
        temp_id = [];

        if(verifCaptcha() === true){
            submit.style.display = "block";
            p.innerHTML = "Validé";
            captchaBtn.style.display = "none";
            validateCaptcha.innerHTML = "<p class='text-success'>Captcha validé <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/Feedbin-Icon-check.svg/1280px-Feedbin-Icon-check.svg.png' width='30' alt='validate'></p>";

        }
    }
}