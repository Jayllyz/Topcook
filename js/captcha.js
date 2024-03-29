let temp_src = [];
let temp_id = [];
let result_images = [];
let verify_images = [];
let compteurForCaptcha = 0;
let p = document.getElementById('captcha-message');
let captchaBtn = document.getElementById('captcha-btn');
let validateCaptcha = document.getElementById('validate-captcha');
validateCaptcha.innerHTML = '';

function randomCaptcha() {
  let request = new XMLHttpRequest();
  request.open('GET', '../includes/random_captcha.php');
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE) {
      const res = request.responseText;
      let div = document.getElementById('puzzle');
      div.innerHTML = '';
      let img1 = document.createElement('img');
      let img2 = document.createElement('img');
      let img3 = document.createElement('img');
      let img4 = document.createElement('img');
      let img5 = document.createElement('img');
      let img6 = document.createElement('img');
      let img7 = document.createElement('img');
      let img8 = document.createElement('img');
      let img9 = document.createElement('img');

      img1.id = '1';
      img2.id = '2';
      img3.id = '3';
      img4.id = '4';
      img5.id = '5';
      img6.id = '6';
      img7.id = '7';
      img8.id = '8';
      img9.id = '9';

      img1.src = 'images/captcha/' + res + '/1.jpg';
      img2.src = 'images/captcha/' + res + '/2.jpg';
      img3.src = 'images/captcha/' + res + '/3.jpg';
      img4.src = 'images/captcha/' + res + '/4.jpg';
      img5.src = 'images/captcha/' + res + '/5.jpg';
      img6.src = 'images/captcha/' + res + '/6.jpg';
      img7.src = 'images/captcha/' + res + '/7.jpg';
      img8.src = 'images/captcha/' + res + '/8.jpg';
      img9.src = 'images/captcha/' + res + '/9.jpg';

      img1.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img2.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img3.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img4.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img5.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img6.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img7.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img8.setAttribute('onclick', 'changeImage(this.src, this.id)');
      img9.setAttribute('onclick', 'changeImage(this.src, this.id)');

      div.appendChild(img1);
      div.appendChild(img2);
      div.appendChild(img3);
      div.appendChild(img4);
      div.appendChild(img5);
      div.appendChild(img6);
      div.appendChild(img7);
      div.appendChild(img8);
      div.appendChild(img9);
      randomImg();
    }
  };
  request.send();
}

function randomImg() {
  let name = document.getElementById('1');
  nameSrc = name.src;
  nameSrc = nameSrc.split('/');
  nameSrc = nameSrc[5];

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
    j++;
    img.src = '../images/captcha/' + nameSrc + '/' + img.id + '.jpg';
  }
}
function verifCaptcha() {
  let count = 0;
  let j = 1;
  let children = document.getElementById('puzzle').children;
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
  document.getElementById(id_image).style.border = '2px solid #17760A';
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
    document.getElementById(temp_id[0]).style.border = 'none';
    document.getElementById(temp_id[1]).style.border = 'none';
    temp_src = [];
    temp_id = [];
    if (verifCaptcha() === true) {
      const sumbit = document.createElement('input');
      sumbit.setAttribute('type', 'submit');
      sumbit.setAttribute('name', 'submit');
      sumbit.setAttribute('id', 'submit');
      sumbit.setAttribute('class', 'btn btn-success');
      sumbit.innerHTML = 'Envoyer';
      document.getElementById('form').appendChild(sumbit);
      p.innerHTML = 'Validé';
      captchaBtn.style.display = 'none';
      validateCaptcha.innerHTML =
        "<p class='text-success'>Captcha validé <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/Feedbin-Icon-check.svg/1280px-Feedbin-Icon-check.svg.png' width='30' alt='validate'></p>";
    }
  }
}
