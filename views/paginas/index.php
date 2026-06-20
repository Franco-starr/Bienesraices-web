 <main class="contenedor seccion">
        <h2 data-cy='Sobre-nosotros'>Mas sobre nosotros</h2>
        <?php include 'iconos.php'; ?>

    </main>

    <section class="seccion contenedor">
        <h2>Casas y depas en ventas</h2>
            <?php 

                $limite = 3;
                include 'listados.php';
            ?>
        

        <div class="alinear-derecha">
            <a data-cy='ver-propiedades' href="/propiedades" class="boton-verde">Ver todas</a>
        </div>
    </section>

    <section  data-cy="imagen-contacto" class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
        <a href="/contacto" class="boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section data-cy="blog" class="blog">
            <h3>Nuestro blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                         <source srcset="/build/img/blog1.jpg" type="image/webp">
                         <source srcset="/build/img/blog1.jpg" type="image/jpg">
                         <img loading="lazy" src="/build/img/blog1.jpg" alt="texto entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
                        
                        <p>
                            Consejos para construir una terraza en el techo de tu casa con las mejoers materiales y ahorrando dinero
                        </p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                         <source srcset="/build/img/blog2.jpg" type="image/webp">
                         <source srcset="/build/img/blog2.jpg" type="image/jpg">
                         <img loading="lazy" src="/build/img/blog2.jpg" alt="texto entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="/entrada">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
                        
                        <p>
                            Maximina el espacio en el hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                        </p>
                    </a>
                </div>
            </article>
        </section>

        <section data-cy="testimoniales" class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comporta de una escelente forma, muy buena atencion y la casa que ofrecieron cumple todas mis expectativas.
                </blockquote>
                <p>- Franco Star</p>
            </div>
        </section>
    </div>