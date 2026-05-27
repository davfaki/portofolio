(() => {
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  document.getElementById('year').textContent = new Date().getFullYear();

  const navToggle = document.querySelector('.nav-toggle');
  const navLinks = document.querySelector('.nav-links');
  const navAnchors = [...document.querySelectorAll('.nav-links a')];

  navToggle.addEventListener('click', () => {
    const expanded = navToggle.getAttribute('aria-expanded') === 'true';
    navToggle.setAttribute('aria-expanded', String(!expanded));
    navLinks.classList.toggle('open');
  });

  navAnchors.forEach((anchor) => {
    anchor.addEventListener('click', () => {
      navToggle.setAttribute('aria-expanded', 'false');
      navLinks.classList.remove('open');
    });
  });

  const cursorLight = document.querySelector('.cursor-light');
  window.addEventListener('pointermove', (event) => {
    document.documentElement.style.setProperty('--mx', `${event.clientX}px`);
    document.documentElement.style.setProperty('--my', `${event.clientY}px`);
    if (cursorLight) {
      cursorLight.style.setProperty('--mx', `${event.clientX}px`);
      cursorLight.style.setProperty('--my', `${event.clientY}px`);
    }
  }, { passive: true });

  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.16 });

  document.querySelectorAll('.reveal').forEach((element) => revealObserver.observe(element));

  const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      const id = entry.target.getAttribute('id');
      navAnchors.forEach((anchor) => {
        anchor.classList.toggle('active', anchor.getAttribute('href') === `#${id}`);
      });
    });
  }, { rootMargin: '-45% 0px -50% 0px' });

  document.querySelectorAll('main section[id]').forEach((section) => sectionObserver.observe(section));

  if (!prefersReduced) {
    document.querySelectorAll('.tilt-card').forEach((card) => {
      card.addEventListener('pointermove', (event) => {
        const rect = card.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        const rotateY = ((x / rect.width) - 0.5) * 13;
        const rotateX = -(((y / rect.height) - 0.5) * 13);
        card.style.setProperty('--rx', `${rotateX.toFixed(2)}deg`);
        card.style.setProperty('--ry', `${rotateY.toFixed(2)}deg`);
      });

      card.addEventListener('pointerleave', () => {
        card.style.setProperty('--rx', '0deg');
        card.style.setProperty('--ry', '0deg');
      });
    });
  }

  const galleryItems = [...document.querySelectorAll('.gallery-item')];
  const lightbox = document.getElementById('lightbox');
  const lightboxImage = lightbox.querySelector('img');
  const lightboxCaption = lightbox.querySelector('figcaption');
  const lightboxClose = lightbox.querySelector('.lightbox-close');
  const lightboxPrev = lightbox.querySelector('.lightbox-prev');
  const lightboxNext = lightbox.querySelector('.lightbox-next');
  let activeGalleryIndex = 0;

  const openLightbox = (index) => {
    activeGalleryIndex = index;
    const item = galleryItems[activeGalleryIndex];
    lightboxImage.src = item.dataset.full;
    lightboxImage.alt = item.querySelector('img').alt;
    lightboxCaption.textContent = item.dataset.title;
    lightbox.hidden = false;
    document.body.classList.add('no-scroll');
    lightboxClose.focus();
  };

  const closeLightbox = () => {
    lightbox.hidden = true;
    document.body.classList.remove('no-scroll');
    lightboxImage.src = '';
    galleryItems[activeGalleryIndex]?.focus();
  };

  const changeLightbox = (direction) => {
    activeGalleryIndex = (activeGalleryIndex + direction + galleryItems.length) % galleryItems.length;
    openLightbox(activeGalleryIndex);
  };

  galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => openLightbox(index));
  });

  lightboxClose.addEventListener('click', closeLightbox);
  lightboxPrev.addEventListener('click', () => changeLightbox(-1));
  lightboxNext.addEventListener('click', () => changeLightbox(1));
  lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) closeLightbox();
  });

  window.addEventListener('keydown', (event) => {
    if (lightbox.hidden) return;
    if (event.key === 'Escape') closeLightbox();
    if (event.key === 'ArrowLeft') changeLightbox(-1);
    if (event.key === 'ArrowRight') changeLightbox(1);
  });

  const canvas = document.getElementById('spaceCanvas');
  const ctx = canvas.getContext('2d');
  let width = 0;
  let height = 0;
  let particles = [];
  let animationId = null;

  const resizeCanvas = () => {
    const ratio = Math.min(window.devicePixelRatio || 1, 2);
    width = canvas.clientWidth;
    height = canvas.clientHeight;
    canvas.width = Math.floor(width * ratio);
    canvas.height = Math.floor(height * ratio);
    ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
  };

  const createParticles = () => {
    const total = Math.min(120, Math.max(60, Math.round(width / 14)));
    particles = Array.from({ length: total }, () => ({
      x: (Math.random() - 0.5) * width * 1.7,
      y: (Math.random() - 0.5) * height * 1.7,
      z: Math.random() * width,
      size: Math.random() * 1.6 + 0.45,
      speed: Math.random() * 1.1 + 0.35,
      hue: Math.random() > 0.5 ? 185 : 292
    }));
  };

  const drawParticles = () => {
    ctx.clearRect(0, 0, width, height);
    const cx = width / 2;
    const cy = height / 2;
    const depth = width;

    for (const particle of particles) {
      particle.z -= particle.speed;
      if (particle.z <= 1) {
        particle.z = depth;
        particle.x = (Math.random() - 0.5) * width * 1.7;
        particle.y = (Math.random() - 0.5) * height * 1.7;
      }

      const k = 170 / particle.z;
      const px = particle.x * k + cx;
      const py = particle.y * k + cy;
      if (px < 0 || px > width || py < 0 || py > height) continue;

      const alpha = Math.max(0, 1 - particle.z / depth);
      ctx.beginPath();
      ctx.fillStyle = `hsla(${particle.hue}, 100%, 70%, ${alpha * 0.74})`;
      ctx.shadowColor = `hsla(${particle.hue}, 100%, 70%, ${alpha})`;
      ctx.shadowBlur = 12;
      ctx.arc(px, py, particle.size * (1.8 - particle.z / depth), 0, Math.PI * 2);
      ctx.fill();
    }

    animationId = requestAnimationFrame(drawParticles);
  };

  const initCanvas = () => {
    if (prefersReduced) return;
    resizeCanvas();
    createParticles();
    drawParticles();
  };

  window.addEventListener('resize', () => {
    resizeCanvas();
    createParticles();
  });

  initCanvas();

  window.addEventListener('pagehide', () => {
    if (animationId) cancelAnimationFrame(animationId);
  });
})();
