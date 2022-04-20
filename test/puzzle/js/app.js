let temp_src = [];
let temp_id = [];
let result_images = [];
let verify_images = [];
let compteur = 0;

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
    img.src = "../../images/captcha/minion/" + img.id + ".jpg";
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
  compteur++;

  temp_src.push(src_image);
  temp_id.push(id_image);
  if (compteur % 2 === 0) {
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

    temp_src = [];
    temp_id = [];
    if(verifCaptcha() === true){
      alert("Bravo vous avez gagné");
    }
  }
}
