<x-layout title="Admin Panel">
<div class="admin-shell">
  <aside class="admin-sidebar">
    <a href="#" class="brand">devlog<span class="cursor"></span></a>
    <nav class="admin-nav">
      <a href="#" class="active">Dashboard</a>
      <a href="#">Postlar</a>
      <a href="#">Foydalanuvchilar</a>
      <a href="#">Xabarlar</a>
      <a href="#">Sozlamalar</a>
      <a href="#">← Saytga qaytish</a>
    </nav>
  </aside>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1>Dashboard</h1>
      <div class="admin-user">
        <span>utkirbek@admin</span>
        <div class="avatar">U</div>
      </div>
    </div>

    <div class="stat-grid">
      <div class="stat-card">
        <div class="label">Jami postlar</div>
        <div class="value">24</div>
        <div class="delta">+3 shu oy</div>
      </div>
      <div class="stat-card">
        <div class="label">Foydalanuvchilar</div>
        <div class="value">318</div>
        <div class="delta">+42 shu oy</div>
      </div>
      <div class="stat-card">
        <div class="label">Xabarlar</div>
        <div class="value">7</div>
        <div class="delta">2 tasi o'qilmagan</div>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <h2>So'nggi postlar</h2>
        <a href="#" class="add-link">+ Yangi post</a>
      </div>
      <table>
        <thead>
          <tr>
            <th>Sarlavha</th>
            <th>Muallif</th>
            <th>Sana</th>
            <th>Holat</th>
            <th>Amallar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Laravel'da birinchi loyihamni qanday boshladim</td>
            <td>Utkirbek</td>
            <td>07.08.2026</td>
            <td><span class="status published">Chop etilgan</span></td>
            <td class="row-actions"><a href="#">tahrirlash</a><a href="#">o'chirish</a></td>
          </tr>
          <tr>
            <td>Interfeys va abstrakt klasslar farqi</td>
            <td>Utkirbek</td>
            <td>02.08.2026</td>
            <td><span class="status published">Chop etilgan</span></td>
            <td class="row-actions"><a href="#">tahrirlash</a><a href="#">o'chirish</a></td>
          </tr>
          <tr>
            <td>JOIN turlari: amaliy misollar bilan</td>
            <td>Utkirbek</td>
            <td>28.07.2026</td>
            <td><span class="status draft">Qoralama</span></td>
            <td class="row-actions"><a href="#">tahrirlash</a><a href="#">o'chirish</a></td>
          </tr>
          <tr>
            <td>PHPStorm + Docker muhitini sozlash</td>
            <td>Utkirbek</td>
            <td>19.07.2026</td>
            <td><span class="status published">Chop etilgan</span></td>
            <td class="row-actions"><a href="#">tahrirlash</a><a href="#">o'chirish</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</div>
</x-layout