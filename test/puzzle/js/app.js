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
  console.log(tabid);
  for (let i = 1; i <= 9; i++) {
    let img = document.getElementById(i).id;
    img = tabid[i];
  }
}

/*    let children = document.getElementById("puzzle").children;

    let idArr = [];

    for (let i = 0; i < children.length; i++) {
        idArr.push(children[i].id);
    }
    */

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
    image_2.src = temp_src[0];

    temp_src = [];
    temp_id = [];
  }
}
