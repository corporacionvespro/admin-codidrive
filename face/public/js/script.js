const MODEL_URL = './public/models';
async function detectFaces() {
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL);
    
    const image = document.getElementById('image');
    
    const detections = await faceapi.detectAllFaces(image);
    const numFaces = detections.length;
    
    if (numFaces === 1) {
        console.log("Se ha detectado 1 rostro.");
    } else {
        console.log(`Se han detectado ${numFaces} rostros.`);
    }
}

const button = document.getElementById('yourButtonId');  // Reemplaza 'yourButtonId' con el ID de tu botón
button.addEventListener('click', detectFaces);

// Definir la función que contiene el código
/*async function detectAndDrawFaces() {
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL);
    await faceapi.loadFaceLandmarkModel(MODEL_URL);
    await faceapi.loadFaceRecognitionModel(MODEL_URL);
    await faceapi.loadFaceExpressionModel(MODEL_URL);

    const image = document.getElementById('image');
    const canvas = document.getElementById('canvas');

    let fullFaceDescriptions = await faceapi.detectAllFaces(image)
        .withFaceLandmarks()
        .withFaceDescriptors()
        .withFaceExpressions();
    console.log(fullFaceDescriptions);
    faceapi.draw.drawDetections(canvas, fullFaceDescriptions);
    faceapi.draw.drawFaceLandmarks(canvas, fullFaceDescriptions);
    faceapi.draw.drawFaceExpressions(canvas, fullFaceDescriptions, 0.05);
}// Asignar la función al evento click del botón
const button = document.getElementById('yourButtonId');  // Reemplaza 'yourButtonId' con el ID de tu botón
button.addEventListener('click', detectAndDrawFaces);*/



/*
(async () => {
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
    await faceapi.loadFaceLandmarkModel(MODEL_URL)
    await faceapi.loadFaceRecognitionModel(MODEL_URL)
    await faceapi.loadFaceExpressionModel(MODEL_URL)

    const image = document.getElementById('image');
    const canvas = document.getElementById('canvas');

    let fullFaceDescriptions = await faceapi.detectAllFaces(image)
        .withFaceLandmarks()
        .withFaceDescriptors()
        .withFaceExpressions();
    console.log(fullFaceDescriptions);
    faceapi.draw.drawDetections(canvas, fullFaceDescriptions);
    faceapi.draw.drawFaceLandmarks(canvas, fullFaceDescriptions);
    faceapi.draw.drawFaceExpressions(canvas, fullFaceDescriptions, 0.05);

})();*/