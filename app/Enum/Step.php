<?php

/**
 * Ensemble des étapes pour la partie resume
 */

namespace App\Enum;

enum Step: string
{
    case STEP_SKILLS = 'skills';
    case STEP_FORMATIONS = 'formations';
    case STEP_JOBS = 'jobs';
    case STEP_HOBBY = 'hobby';
}
