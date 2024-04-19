<?php

class PortfolioData {
    public string $por_titulo;
    public string $por_nombre;
    public string $por_apellidos;
    public string $por_especialidad;
    public string $por_telefono;
    public string $por_email;
    public string $por_github;
    public string $por_linkedin;
    public string $por_tik_tok;
    public string $por_instagram;
    public string $por_twitter; 
    public string $por_skills;
    public string $por_sobre_mi;

    public function __construct(
        string $por_titulo,
        string $por_nombre,
        string $por_apellidos,
        string $por_especialidad,
        string $por_telefono,
        string $por_email,
        string $por_github = '',
        string $por_linkedin = '',
        string $por_tik_tok = '',
        string $por_instagram = '',
        string $por_twitter = '',
        string $por_skills = '',
        string $por_sobre_mi = ''
    ) {
        $this->por_titulo = $por_titulo;
        $this->por_nombre = $por_nombre;
        $this->por_apellidos = $por_apellidos;
        $this->por_especialidad = $por_especialidad;
        $this->por_telefono = $por_telefono;
        $this->por_email = $por_email;
        $this->por_github = $por_github;
        $this->por_linkedin = $por_linkedin;
        $this->por_tik_tok = $por_tik_tok;
        $this->por_instagram = $por_instagram;
        $this->por_twitter = $por_twitter;
        $this->por_skills = $por_skills;
        $this->por_sobre_mi = $por_sobre_mi;
    }
}