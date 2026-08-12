<x-layout title="Contact">

    <section class="page-header">
        <div class="prompt">contact --send</div>
        <h1>Bog'lanish</h1>
        <p>Savol, taklif yoki hamkorlik bo'yicha murojaat qiling.</p>
    </section>

    <section class="contact-wrap">
        <div class="contact-form">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="c-name">ism</label>
                    <input type="text" id="c-name" name="name" placeholder="Ismingiz" required>
                </div>
                <div class="form-group">
                    <label for="c-email">email</label>
                    <input type="email" id="c-email" name="email" placeholder="siz@example.com" required>
                </div>
                <div class="form-group">
                    <label for="c-message">xabar</label>
                    <textarea id="c-message" name="message" placeholder="Xabaringizni yozing..." required></textarea>
                </div>
                <button type="submit" class="btn">Yuborish</button>
            </form>
        </div>
    </section>
</x-layout>
