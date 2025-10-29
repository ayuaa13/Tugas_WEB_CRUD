// Ambil elemen dari DOM berdasarkan id
const genderInput = document.getElementById("gender");
const ageInput = document.getElementById("age");
const heightInput = document.getElementById("height");
const weightInput = document.getElementById("weight");
const activityInput = document.getElementById("activity");
const resultBMR = document.getElementById("resultBMR");
const resultCalories = document.getElementById("resultCalories");
const calcBtn = document.getElementById("calcBtn");

// Faktor aktivitas (PAL values)
const activityFactor = {
  "Sedentary": 1.2,
  "Lightly Active": 1.375,
  "Moderately Active": 1.55,
  "Very Active": 1.725,
  "Extra Active": 1.9
};

// Event listener untuk tombol "Hitung Kalori"
calcBtn.addEventListener("click", function () {
  const gender = genderInput.value;
  const age = parseInt(ageInput.value);
  const height = parseInt(heightInput.value);
  const weight = parseInt(weightInput.value);
  const activity = activityInput.value;

  // Validasi input
  if (gender === "Pilih" || !age || !height || !weight || activity === "Pilih") {
    alert("⚠️ Harap lengkapi semua data sebelum menghitung!");
    return;
  }

  // Hitung BMR dengan rumus Mifflin-St Jeor
  let bmr;
  if (gender === "Pria") {
    bmr = 88.36 + (13.4 * weight) + (4.8 * height) - (5.7 * age);
  } else if (gender === "Wanita") {
    bmr = 447.6 + (9.2 * weight) + (3.1 * height) - (4.3 * age);
  }

  // Hitung kebutuhan kalori harian
  const dailyCalories = bmr * activityFactor[activity];

  // Tampilkan hasil ke halaman
  resultBMR.textContent = `BMR (Basal Metabolic Rate): ${Math.round(bmr)} kcal`;
  resultCalories.textContent = `Kebutuhan Kalori Harian: ${Math.round(dailyCalories)} kcal`;
});
