# RentWise - Your Smart Property Rental & Selling Platform 🏠

Welcome to **RentWise**, your ultimate solution for renting and selling properties efficiently. With a dynamic UI and robust database connectivity, RentWise streamlines the property management experience for **clients, admins, and property managers**.

---

## 🔎 Features

### 📊 Dashboard Overview
Gain insights into your property management with:
- **Total Listings**: Track active rental and sale properties.
- **User Management**: Admins can monitor users and transactions.
- **Performance Metrics**: View rental trends and property status.

### ✅ Easy Property Management
- Add, edit, and delete property listings effortlessly.
- Upload images and provide detailed descriptions.
- Categorize properties for easy searchability.

### 📈 Search & Filters
- Advanced filters based on price, location, property type, and availability.
- Keyword-based search for quick results.
- Real-time property updates.

### 🛡️ Secure & Reliable
- **User Authentication**: Secure login for both clients and admins.
- **Database Security**: MySQL-backed data protection.
- **Admin Control**: Manage users, properties, and transactions securely.

### 🌐 Multi-Platform Compatibility
- Works seamlessly across desktops, tablets, and mobile devices.
- Responsive design ensures smooth navigation on all screen sizes.

---

## 📚 AI-Powered Price Estimation
RentWise incorporates an AI-trained model that estimates the selling price of properties based on:
- **City**: Dataset includes 8 metropolitan cities.
- **Property Type**: Categorization of property types.
- **Furniture Status**: Whether furnished, semi-furnished, or unfurnished.
- **Area in Square Feet**: Calculates price based on property size.

### 🛠️ Technologies Used for AI Model
- **Programming Language**: Python
- **Framework**: Flask for API deployment
- **Libraries**: Pandas, NumPy, Scikit-learn, Matplotlib
- **Development Tools**: PyCharm, Jupyter Notebook

---

## 📚 Installation
Follow these steps to set up RentWise on your local machine:

### 1️⃣ Clone the Repository
```sh
$ git clone https://github.com/Utsav9303/RentWise.git
$ cd Rent_Wise
```

### 2️⃣ Install Dependencies
Ensure you have XAMPP or WAMP installed. Then:

- Start **Apache** and **MySQL** services.
- Place the project folder inside `htdocs` (for XAMPP users).

### 3️⃣ Setup Database
- Navigate to the `database` folder.
- Import `rentwise.sql` into MySQL.
- Update `server/connection.php` with your database credentials.

### 4️⃣ Start the Server
- Access the platform via `http://localhost/Rent_Wise/`.

### 5️⃣ Run AI Model (Optional)
- Navigate to `ai_model/` directory.
- Install dependencies using:
  ```sh
  pip install -r requirements.txt
  ```
- Run the Flask API:
  ```sh
  python app.py
  ```
- The model API will be available at `http://localhost:5000`.

---

## 💂 Folder Structure
```
/Rent_Wise
│-- /admin         # Admin panel files
│-- /client        # Client-side pages
│-- /css           # Stylesheets
│-- /database      # MySQL database scripts
│-- /home          # Homepage files
│-- /img           # Images
│-- /jquerydata    # jQuery-related files
│-- /js            # JavaScript files
│-- /links         # External dependencies
│-- /login-signup  # Authentication system
│-- /server        # Backend PHP scripts
│-- /shortlink     # Common includes (header, footer, database connection)
│-- /Uploads       # Uploaded property images
│-- /ai_model      # AI-based price estimation model
│-- index.php      # Main entry point
```

---

## 📢 Contributing
We welcome contributions to improve RentWise! Feel free to:
- Report issues.
- Submit feature requests.
- Create pull requests for bug fixes or new features.

### 🚀 How to Contribute
1. **Fork the repository**.
2. **Create a new branch**: `git checkout -b feature-branch`.
3. **Commit your changes**: `git commit -m 'Added new feature'`.
4. **Push to the branch**: `git push origin feature-branch`.
5. **Open a Pull Request**.

---

## 🔧 Technologies Used
- **Frontend**: HTML, CSS, JavaScript, jQuery
- **Backend**: PHP, MySQL, Flask (for AI model)
- **Database**: MySQL
- **AI Model**: Python, Scikit-learn, Pandas, NumPy
- **Version Control**: Git & GitHub

---

## 🎤 Feedback
Your feedback is valuable! Share your suggestions or report issues via GitHub.

## 💖 License
This project is licensed under the **MIT License**.

Start managing your properties smartly with **RentWise** today! 🚀

