<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - ZenMindSet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            padding: 20px;
        }

        .section-title {
            text-align: center;
            color: #861124;
            margin: 20px 0;
            font-size: 1.8em;
        }

        .book-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .book-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 250px;
            transition: transform 0.3s ease;
            text-align: center;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-card img {
            width: 100%;
            height: auto;
        }

        .book-content {
            padding: 15px;
        }

        .book-title {
            color: #861124;
            font-size: 1.2em;
            margin: 10px 0;
        }

        .book-author {
            color: #555;
            margin-bottom: 8px;
            font-size: 1em;
        }

        .book-price {
            color: #333;
            font-weight: bold;
        }

        .details-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            color: #fff;
            background-color: #861124;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .details-btn:hover {
            background-color: #a51732;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .modal-header {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #861124;
        }

        .modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-details {
            margin-top: 10px;
            font-size: 1em;
            color: #333;
        }
        
        .availability {
            font-weight: bold;
            color: #861124;
        }
    </style>
</head>
<body>
 

        <!-- Fictional Section -->
        <h2 class="section-title">Fictional</h2>
        <div class="book-grid" id="fictionalBooks">
       
            <div class="book-card" onclick="showModal('The Alchemist', 'Paulo Coelho', 'Rs 1750', 'In Stock')">
                <img src="../images/book1.jpg" alt="The Alchemist">
                <div class="book-content">
                    <h3 class="book-title">The Alchemist</h3>
                    <p class="book-author">Paulo Coelho</p>
                    <p class="book-price">Rs 1750</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('Siddartha', 'Hermann Hesse', 'Rs 2000', 'In Stock')">
                <img src="../images/book2.jpg" alt="Fiction Book 2">
                <div class="book-content">
                    <h3 class="book-title">Siddhartha</h3>
                    <p class="book-author">Hermann Hesse</p>
                    <p class="book-price">Rs 2000</p>
                    <p class="availability">In Stock</p>
                    
                </div>
            </div>
            <div class="book-card" onclick="showModal('To Kill a Mockingbird', 'Harper Lee', 'Rs 1190', 'Out of Stock')">
                <img src="../images/book9.jpg" alt="Fiction Book 2">
                <div class="book-content">
                    <h3 class="book-title">To Kill a Mockingbird</h3>
                    <p class="book-author">Harper Lee</p>
                    <p class="book-price">Rs 1190</p>
                    <p class="availability">Out of Stock</p>
                   
                </div>
            </div>
            <div class="book-card" onclick="showModal('1984', 'George Orwell', 'Rs 2400', 'In Stock')">
                <img src="../images/book10.jpg" alt="Fiction Book 2">
                <div class="book-content">
                    <h3 class="book-title">1984</h3>
                    <p class="book-author">George Orwell</p>
                    <p class="book-price">Rs 2400</p>
                    <p class="availability">In Stock</p>
                    
                </div>
            </div>
        </div>

        <!-- Nonfictional Section -->
        <h2 class="section-title">Nonfictional</h2>
        <div class="book-grid" id="nonfictionalBooks">
        <div class="book-card" onclick="showModal('Atomic Habits', 'James Clear', 'Rs 2400', 'In Stock')">
                <img src="../images/book3.jpg" alt="Nonfiction Book 1">
                <div class="book-content">
                    <h3 class="book-title">Atomic Habits</h3>
                    <p class="book-author">James Clear</p>
                    <p class="book-price">Rs 2400</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('Educated', 'Tara Westover', 'Rs 1250', 'In Stock')">
                <img src="../images/book4.jpg" alt="Nonfiction Book 2">
                <div class="book-content">
                    <h3 class="book-title">Educated</h3>
                    <p class="book-author">Tara Westover</p>
                    <p class="book-price">Rs 1250</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Rs 1250', 'In Stock')">
                <img src="../images/book11.jpg" alt="Nonfiction Book 2">
                <div class="book-content">
                    <h3 class="book-title">Sapiens: A Brief History of Humankind</h3>
                    <p class="book-author">Yuval Noah Harari</p>
                    <p class="book-price">Rs 1250</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('Becoming', 'Michelle Obama', 'Rs 750', 'Out of Stock')">
                <img src="../images/book12.jpg" alt="Nonfiction Book 2">
                <div class="book-content">
                    <h3 class="book-title">Becoming</h3>
                    <p class="book-author">Michelle Obama</p>
                    <p class="book-price">Rs 750</p>
                    <p class="availability">Out of Stock</p>
                </div>
            </div>
        </div>

        <!-- Meditation Section -->
        <h2 class="section-title">Meditation</h2>
        <div class="book-grid" id="meditationBooks">
        <div class="book-card" onclick="showModal('The Power of Now', 'Eckhart Tolle', 'Rs 899', 'In Stock')">
                <img src="../images/book5.jpg" alt="Meditation Book 1">
                <div class="book-content">
                    <h3 class="book-title">The Power of Now</h3>
                    <p class="book-author">Eckhart Tolle</p>
                    <p class="book-price">Rs 899</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('Wherever You Go, There You Are', 'Jon Kabat-Zinn', 'Rs 1000', 'In Stock')">
                <img src="../images/book6.jpg" alt="Meditation Book 2">
                <div class="book-content">
                    <h3 class="book-title">Wherever You Go, There You Are</h3>
                    <p class="book-author">Jon Kabat-Zinn</p>
                    <p class="book-price">Rs 1000</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('The Headspace Guide to Meditation and Mindfulness', 'Andy Puddicombe', 'Rs 1000', 'In Stock')">
                <img src="../images/book13.jpg" alt="Meditation Book 2">
                <div class="book-content">
                    <h3 class="book-title">The Headspace Guide to Meditation and Mindfulness</h3>
                    <p class="book-author">Andy Puddicombe</p>
                    <p class="book-price">$20.99</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('The Power of Now', 'Eckhart Tolle', 'Rs 1450', 'In Stock')">
                <img src="../images/book14.jpg" alt="Meditation Book 2">
                <div class="book-content">
                    <h3 class="book-title">The Power of Now</h3>
                    <p class="book-author">Eckhart Tolle</p>
                    <p class="book-price">Rs 1450</p>
                    <<p class="availability">In Stock</p>
                </div>
            </div>
        </div>

        <!-- Workbook Section -->
        <h2 class="section-title">Workbooks</h2>
        <div class="book-grid" id="workbookBooks">
        <div class="book-card" onclick="showModal('The Anxiety and Phobia Workbook', 'Edmund J. Bourne', 'Rs 3000', 'In Stock')">
                <img src="../images/book7.jpg" alt="Workbook 1">
                <div class="book-content">
                    <h3 class="book-title">The Anxiety and Phobia Workbook</h3>
                    <p class="book-author">Edmund J. Bourne</p>
                    <p class="book-price">Rs 3000</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('Mind Over Mood', 'Dennis Greenberger', 'Rs 1260', 'In Stock')">
                <img src="../images/book8.jpg" alt="Workbook 2">
                <div class="book-content">
                    <h3 class="book-title">Mind Over Mood</h3>
                    <p class="book-author">Dennis Greenberger</p>
                    <p class="book-price">Rs 1260</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('The Anxiety and Phobia Workbook', 'Edmund J. Bourne', 'Rs 1260', 'In Stock')">
                <img src="../images/book15.jpg" alt="Workbook 2">
                <div class="book-content">
                    <h3 class="book-title">The Anxiety and Phobia Workbook</h3>
                    <p class="book-author">Edmund J. Bourne</p>
                    <p class="book-price">Rs 1260</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
            <div class="book-card" onclick="showModal('The Depression Workbook', 'Mary Ellen Copeland', 'Rs 2459', 'In Stock')">
                <img src="../images/book16.jpg" alt="Workbook 2">
                <div class="book-content">
                    <h3 class="book-title">The Depression Workbook</h3>
                    <p class="book-author"> Mary Ellen Copeland</p>
                    <p class="book-price"> Rs 2450</p>
                    <p class="availability">In Stock</p>
                </div>
            </div>
        </div>
    </div>

  
<!-- Modal Structure -->
<div id="bookModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <h2 class="modal-header" id="modalTitle"></h2>
        <p class="modal-details" id="modalAuthor"></p>
        <p class="modal-details" id="modalPrice"></p>
        <p class="modal-details" id="modalAvailability"></p>
    </div>
</div>

<script>
    function showModal(title, author, price, availability) {
        document.getElementById("modalTitle").innerText = title;
        document.getElementById("modalAuthor").innerText = "Author: " + author;
        document.getElementById("modalPrice").innerText = "Price: " + price;
        document.getElementById("modalAvailability").innerText = "Availability: " + availability;
        document.getElementById("bookModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("bookModal").style.display = "none";
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById("bookModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
