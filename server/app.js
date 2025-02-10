document.addEventListener("DOMContentLoaded", function () {
    let selectedCity = localStorage.getItem('selectedCity') || 'Ahmedabad';
    console.log("Selected City:", selectedCity);
    
    function loadLocalities() {
        let url = `http://192.168.240.17:5000/get_localities?city=${encodeURIComponent(selectedCity)}`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                let localityDropdown = document.getElementById('locality');
                localityDropdown.innerHTML = "";
                data.localities.forEach(locality => {
                    let option = document.createElement("option");
                    option.value = locality;
                    option.textContent = locality;
                    localityDropdown.appendChild(option);
                });
            })
            .catch(error => console.error("Error fetching localities:", error));
    }
    
    function predictPrice() {
        let url = "http://192.168.240.17:5000/predict";
        let area = document.getElementById("area").value;
        let bhk = document.getElementById("bhk").value;
        let propertyType = document.getElementById("property_type").value;
        let furnishType = document.getElementById("furnish_type").value;
        let locality = document.getElementById("locality").value;
        
        if (!area || area <= 0) {
            alert("Please enter a valid area in square feet.");
            return;
        }

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                city: selectedCity,
                area: parseFloat(area),
                bhk: parseInt(bhk),
                property_type: propertyType,
                furnish_type: furnishType,
                locality: locality
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("API Response:", data);
            let resultDiv = document.getElementById("result");
            if (data && typeof data.prediction === "number") {
                resultDiv.innerHTML = `<h2>${data.prediction.toFixed(2)} Lakh</h2>`;
            } else {
                console.error("Prediction is missing or invalid:", data);
                resultDiv.innerHTML = "<h2>Error: Prediction not available</h2>";
            }
        })
        .catch(error => {
            console.error("Error fetching prediction:", error);
            document.getElementById("result").innerHTML = "<h2>Error Fetching Prediction</h2>";
        });
    }
    
    document.getElementById("predictBtn").addEventListener("click", predictPrice);
    loadLocalities();
});
