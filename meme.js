const imageFileInput = document.querySelector("#imageFileInput");
const topTextInput = document.querySelector("#topTextInput");
const bottomTextInput = document.querySelector("#bottomTextInput");
const textColorInput = document.querySelector("#textColorInput");
const textBorderColorInput = document.querySelector("#textBorderColorInput");
const canvas = document.querySelector("#meme");
const downloadButton = document.querySelector("#downloadButton");
const but = document.querySelector(".but");

let image;

imageFileInput.addEventListener("change", () => {
  const imageDataUrl = URL.createObjectURL(imageFileInput.files[0]);

  image = new Image();
  image.src = imageDataUrl;

  image.addEventListener("load", () => {
    updateMemeCanvas(
      canvas,
      image,
      topTextInput.value,
      bottomTextInput.value,
      textColorInput.value,
      textBorderColorInput.value
    );
  });
});

topTextInput.addEventListener("input", () => {
  console.log(topTextInput.value);
  updateMemeCanvas(
    canvas,
    image,
    topTextInput.value,
    bottomTextInput.value,
    textColorInput.value,
    textBorderColorInput.value
  );
});

bottomTextInput.addEventListener("input", () => {
  updateMemeCanvas(
    canvas,
    image,
    topTextInput.value,
    bottomTextInput.value,
    textColorInput.value,
    textBorderColorInput.value
  );
});

downloadButton.addEventListener("click", () => {
  const dataUrl = canvas.toDataURL();
  const a = document.createElement("a");
  a.href = dataUrl;
  a.download = "meme.jpg";
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
});

function updateMemeCanvas(
  canvas,
  image,
  topText,
  bottomText,
  textColor,
  textBorderColor
) {
  canvas.style.display = "block";
  but.style.display = "block";
  const ctx = canvas.getContext("2d");
  const width = image.width;
  const height = image.height;
  const fontSize = Math.floor(width / 10);
  const yOffset = height / 25;

  canvas.width = width;
  canvas.height = height;
  ctx.drawImage(image, 0, 0);

  ctx.strokeStyle = textBorderColor;
  ctx.lineWidth = Math.floor(fontSize / 4);
  ctx.fillStyle = textColor;
  ctx.textAlign = "center";
  ctx.lineJoin = "round";
  ctx.font = `${fontSize}px sans-serif`;

  ctx.textBaseline = "top";
  ctx.strokeText(topText, width / 2, yOffset);
  ctx.fillText(topText, width / 2, yOffset);

  ctx.textBaseline = "bottom";
  ctx.strokeText(bottomText, width / 2, height - yOffset);
  ctx.fillText(bottomText, width / 2, height - yOffset);
}
