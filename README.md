# Rent Wise Platform

## Overview

Rent Wise is a web-based platform that allows users to rent and sell properties efficiently. It provides separate modules for **clients**, **admins**, and **property management** with a dynamic UI and database connectivity.

## Features

- **User Authentication**: Secure signup/login for clients and admins.
- **Property Listings**: Add, edit, and delete property listings.
- **Search & Filters**: Advanced search functionality for users.
- **Admin Dashboard**: Manage users, properties, and transactions.
- **Responsive Design**: Works across multiple screen sizes.

## Tech Stack

- **Backend**: PHP, MySQL
- **Frontend**: HTML, CSS, JavaScript, jQuery
- **Database**: MySQL
- **Version Control**: Git & GitHub

## Installation

1. **Clone the Repository**
   ```sh
   git clone https://github.com/Utsav9303/RentWise.git
   ```
2. **Navigate to the Project Directory**
   ```sh
   cd Rent_Wise
   ```
3. **Setup Database**
   - Navigate to the `database` folder.
   - Import the `rentwise.sql` file into MySQL.
   - Update `server/connection.php` with your database credentials.
4. **Start the Server**
   - Use XAMPP or WAMP to start `Apache` and `MySQL`.
   - Place the project folder inside the `htdocs` directory (for XAMPP).
   - Access via `http://localhost/Rent_Wise/`.

## Folder Structure

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
│-- index.php      # Main entry point
```

## Usage

- **User Registration & Login**
- **Add and Manage Properties**
- **Search & Filter Listings**
- **Admin Control Panel**

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -m 'Added new feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a Pull Request.

## License

This project is licensed under the **MIT License**.

---

**Author:** Utsav Modi\
**GitHub:** [Utsav9303](https://github.com/Utsav9303)

