<script src="/test2/social-app/assets/js/script.js"></script>
<audio id="bg-music" autoplay loop>
    <source src="/test2/social-app/assets/music/bg.mp3" type="audio/mpeg">
</audio>

<button onclick="toggleMusic()" id="music-btn" style="position:fixed; bottom:20px; right:20px; background:#d4ff00; color:#111; border:none; padding:8px 14px; border-radius:30px; font-weight:bold; cursor:pointer; z-index:999;">
    🎵 Musique
</button>

<script>
function toggleMusic() {
    var audio = document.getElementById('bg-music');
    var btn = document.getElementById('music-btn');
    if (audio.paused) {
        audio.play();
        btn.textContent = '🎵 Musique';
    } else {
        audio.pause();
        btn.textContent = '🔇 Muet';
    }
}
</script>
</body>
</html>