<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Les Privat Guru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
    
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
}

html {
    scroll-behavior: smooth;
}

body {
    background-color: #f8fafc;
    color: #334155;
    line-height: 1.6;
}


.hero {
    background: linear-gradient(-45deg, #4facfe, #00f2fe, #4facfe);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    color: white;
    text-align: center;
    padding: 120px 20px;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 20px;
    font-weight: 800;
    letter-spacing: -1px;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 35px;
    opacity: 0.9;
}

.hero .btn {
    display: inline-block;
    background-color: white;
    color: #007bff;
    padding: 14px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.hero .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.about {
    padding: 80px 20px;
    text-align: center;
    background-color: white;
}

.about h2 {
    font-size: 2rem;
    color: #1e293b;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.about h2::after {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background: #4facfe;
    margin: 10px auto 0;
    border-radius: 2px;
}


.fitur {
    padding: 80px 20px;
    background-color: #f1f5f9;
}

.fitur h2 {
    text-align: center;
    margin-bottom: 40px;
}

.fitur ul {
    list-style: none;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    max-width: 1100px;
    margin: auto;
}

.fitur li {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
    text-align: left;
    border-bottom: 4px solid transparent;
}

.fitur li:hover {
    transform: translateY(-10px);
    border-bottom: 4px solid #4facfe;
}

.cta {
    background: #1e293b; 
    color: white;
    text-align: center;
    padding: 70px 20px;
}

.cta .btn {
    background: #4facfe;
    color: white;
    padding: 14px 40px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    transition: 0.3s;
}

.cta .btn:hover {
    background: #00f2fe;
}


footer {
    background-color: #0f172a;
    color: #94a3b8;
    text-align: center;
    padding: 30px;
    font-size: 14px;
}

.top-login {
    position: fixed;
    top: 20px;
    right: 20px;
    display: flex;
    gap: 10px;
    z-index: 1000;
}

.admin-login,
.guru-login {
    background: rgba(255,255,255,0.9);
    color: #007bff;
    padding: 10px 22px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.admin-login:hover {
    background: #007bff;
    color: white;
    transform: translateY(-2px);
}

.guru-login:hover {
    background: #1e293b;
    color: white;
    transform: translateY(-2px);
}



   </style>
</head>
<body>
    <div class="top-login">
    <a href="LoginGuru.php" class="guru-login">Guru</a>
    <a href="LoginAdmin.php" class="admin-login">Admin</a>
</div>



   
    <section class="hero">
        <h1>Les Privat Guru Profesional</h1>
        <p>Solusi belajar mudah, fleksibel, dan terpercaya</p>
        <a href="Guru.html" class="btn">Masuk</a>
        
    </section>

    <section class="about">
        <h2>Tentang Kami</h2>
        <p>
            Platform les privat yang mempertemukan siswa dengan guru
            berpengalaman sesuai mata pelajaran yang dibutuhkan.
        </p>
    </section>

    <section class="fitur">
        <h2>Kenapa Pilih Kami?</h2>
        <ul>
            <li>✅ Guru berpengalaman</li>
            <li>✅ Jadwal fleksibel</li>
            <li>✅ Harga transparan</li>
            <li>✅ Pemesanan mudah</li>
        </ul>
    </section>

    <section class="cta">
        <h2>Mulai Belajar Sekarang</h2>
        <a href="login.php" class="btn">Pesan Les</a>
    </section>

   
    <footer>
        <p>© <?php echo date("Y"); ?> Les Privat Guru</p>
    </footer>

</body>
</html>
