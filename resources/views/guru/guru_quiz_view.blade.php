@extends('guru.guru_master')

@section('guru')

<!-- Tambahkan link Font Awesome jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
    }

    .classroom-container {
        background: linear-gradient(135deg, #1d2b64, #f8cdda);
        padding: 50px 25px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        color: #fff;
        animation: gradient 8s ease infinite;
        background-size: 400% 400%;
        text-align: center;
    }

    @keyframes gradient {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }

    .classroom-container h2 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 25px;
        text-shadow: 2px 2px 5px rgba(0,0,0,0.4);
    }

    .game-rules {
        background: rgba(255, 255, 255, 0.15);
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .game-rules ul {
        list-style: none;
        padding: 0;
    }

    .game-rules li::before {
        content: "🎯";
        margin-right: 10px;
    }

    .add-game-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
    }

    .add-game-form input {
        padding: 12px;
        width: 80%;
        max-width: 400px;
        border: none;
        border-radius: 8px;
        margin-bottom: 10px;
        outline: none;
    }

    .add-game-form button {
        background-color: #ff9800;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
    }

    .add-game-form button:hover {
        background-color: #e68a00;
        transform: translateY(-2px);
    }

    .game-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
        justify-content: center;
    }

    .game-container {
        background: #ffffff;
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
    }

    .game-container:hover {
        transform: scale(1.03);
    }

    .game-container iframe {
        border-radius: 10px;
        width: 100%;
        height: 280px;
    }

    .action-buttons {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .action-buttons button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        transition: 0.3s;
    }

    .edit-btn:hover { color: #ff9800; }
    .delete-btn:hover { color: #e53935; }

    .start-button {
        display: inline-block;
        margin-top: 30px;
        padding: 14px 28px;
        background: #00bcd4;
        color: #fff;
        font-size: 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s ease-in-out;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }

    .start-button:hover {
        background: #0097a7;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .add-game-form {
            width: 100%;
        }
    }
</style>

<div class="classroom-container">
    <h2>🎮 Selamat Datang di Zona Game Edukasi! 🚀</h2>

    <div class="game-rules">
        <p><strong>📚 Aturan Main:</strong></p>
        <ul>
            <li>Fokus dan semangat saat bermain!</li>
            <li>Jalin kerjasama tim yang baik!</li>
            <li>Coba terus walau salah!</li>
            <li>Serap ilmunya dan bersenang-senang! 😄</li>
        </ul>
    </div>

    <div class="add-game-form" id="adminPanel">
        <input type="text" id="gameUrl" placeholder="🔗 Masukkan embed URL game edukasi">
        <button onclick="addGame()"><i class="fas fa-plus-circle"></i> Tambah Game</button>
    </div>

    <div class="game-list" id="gameList">
        <div class="game-container">
            <iframe src="https://wordwall.net/embed/424629c28c6c4e5d92ca153b60b89af4?themeId=23&templateId=30&fontStackId=12" frameborder="0" allowfullscreen></iframe>
            <div class="action-buttons">
                <button class="edit-btn" onclick="editGame(this)"><i class="fas fa-edit"></i></button>
                <button class="delete-btn" onclick="deleteGame(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </div>

    <a href="https://wordwall.net" target="_blank" class="start-button">🌐 Eksplor Game Lain</a>
</div>

<script>
    function addGame() {
        const gameUrl = document.getElementById("gameUrl").value.trim();

        if (!gameUrl.startsWith("https://")) {
            alert("Pastikan link embed diawali dengan https://");
            return;
        }

        const container = document.createElement("div");
        container.className = "game-container";
        container.innerHTML = `
            <iframe src="${gameUrl}" frameborder="0" allowfullscreen></iframe>
            <div class="action-buttons">
                <button class="edit-btn" onclick="editGame(this)"><i class="fas fa-edit"></i></button>
                <button class="delete-btn" onclick="deleteGame(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
        `;
        document.getElementById("gameList").appendChild(container);
        document.getElementById("gameUrl").value = "";
    }

    function deleteGame(button) {
        if (confirm("Yakin ingin menghapus game ini?")) {
            button.closest(".game-container").remove();
        }
    }

    function editGame(button) {
        const iframe = button.closest(".game-container").querySelector("iframe");
        const newUrl = prompt("Masukkan embed URL baru:", iframe.src);
        if (newUrl) iframe.src = newUrl;
    }
</script>

@endsection
