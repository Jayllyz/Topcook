let temp_src = [];
let temp_id = [];
let result_images = [];
let verify_images = [];
let compteur = 0;
function changeImage(src_image, id_image) {
    compteur++;

    temp_src.push(src_image);
    temp_id.push(id_image);
    if(compteur % 2 === 0) {
        // Echanger l'image 1 et 2
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




        // Echanger l'image 1 et 2
        let image_1 = document.getElementById(temp_id[0]);
        let image_2 = document.getElementById(temp_id[1]);
        image_1.src = temp_src[1];
        image_2.src = temp_src[0];

        // Supprimer les images temporaires
        temp_src = [];
        temp_id = [];

        console.log(result_images);

    }


}