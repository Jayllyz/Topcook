function changeColor() {
  let colorHair = document.getElementById('colorHair').value;
  let colorHat = document.getElementById('colorHat').value;
  let colorSweat = document.getElementById('colorSweat').value;
  let colorEyes = document.getElementById('colorEyes').value;
  let colorBeard = document.getElementById('colorBeard').value;
  let colorBody = document.getElementById('colorBody').value;

  colorHair = colorHair.slice(1);
  colorHat = colorHat.slice(1);
  colorSweat = colorSweat.slice(1);
  colorEyes = colorEyes.slice(1);
  colorBeard = colorBeard.slice(1);
  colorBody = colorBody.slice(1);

  const request = new XMLHttpRequest();
  request.open('POST', 'https://topcook.site/avatar/addColor.php');
  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
      reloadAvatar();
    }
  };
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(
    `colorBody=${colorBody}&colorHair=${colorHair}&colorHat=${colorHat}&colorSweat=${colorSweat}&colorEyes=${colorEyes}&colorBeard=${colorBeard}`,
  );
}

function activateAvatar() {
  const request = new XMLHttpRequest();
  request.open('GET', 'https://topcook.site/avatar/activateAvatar.php');
  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
      location.reload();
    }
  };
  request.send();
}
