// Ambil elemen dari halaman
const genderInput = document.getElementById("gender");
const ageInput = document.getElementById("age");
const heightInput = document.getElementById("height");
const weightInput = document.getElementById("weight");
const activityInput = document.getElementById("activity");
const resultBMR = document.getElementById("resultBMR");
const resultCalories = document.getElementById("resultCalories");
const calcBtn = document.getElementById("calcBtn");

const activityFactor = {
  "Sedentary": 1.2,
  "Lightly Active": 1.375,
  "Moderately Active": 1.55,
  "Very Active": 1.725,
  "Extra Active": 1.9
};

calcBtn.addEventListener("click", function () {
  const gender = genderInput.value;
  const age = parseInt(ageInput.value);
  const height = parseFloat(heightInput.value);
  const weight = parseFloat(weightInput.value);
  const activity = activityInput.value;

  if (gender === "Pilih" || !age || !height || !weight || activity === "Pilih") {
    alert("⚠️ Lengkapi semua data dulu, ya!");
    return;
  }

  // Hitung BMR
  let bmr;
  if (gender === "Pria") {
    bmr = 88.36 + (13.4 * weight) + (4.8 * height) - (5.7 * age);
  } else {
    bmr = 447.6 + (9.2 * weight) + (3.1 * height) - (4.3 * age);
  }

  const dailyCalories = bmr * activityFactor[activity];

  // Tampilkan hasil di layar
  resultBMR.textContent = `BMR (Basal Metabolic Rate): ${Math.round(bmr)} kcal`;
  resultCalories.textContent = `Kebutuhan Kalori Harian: ${Math.round(dailyCalories)} kcal`;

  // Isi form tersembunyi
  document.getElementById("formGender").value = gender;
  document.getElementById("formAge").value = age;
  document.getElementById("formHeight").value = height;
  document.getElementById("formWeight").value = weight;
  document.getElementById("formActivity").value = activity;
  document.getElementById("formBMR").value = Math.round(bmr);
  document.getElementById("formCalories").value = Math.round(dailyCalories);

  // Kirim data otomatis tanpa konfirmasi
  document.getElementById("saveForm").submit();
});
