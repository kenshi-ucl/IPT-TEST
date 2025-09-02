import pygame
import random
import sys

# Initialize pygame
pygame.init()

# Screen setup
WIDTH, HEIGHT = 400, 600
screen = pygame.display.set_mode((WIDTH, HEIGHT))
pygame.display.set_caption("Flappy Bird")

# Colors
WHITE = (255, 255, 255)
BLUE = (135, 206, 235)
GREEN = (0, 200, 0)

# Game variables
gravity = 0.5
bird_movement = 0
game_active = True
score = 0
high_score = 0

# Fonts
game_font = pygame.font.SysFont("Arial", 32)

# Load bird (use a simple rectangle if no image)
bird = pygame.Rect(WIDTH//4, HEIGHT//2, 30, 30)

# Pipes
pipe_width = 70
pipe_height = 400
pipe_gap = 150
pipe_list = []
SPAWNPIPE = pygame.USEREVENT
pygame.time.set_timer(SPAWNPIPE, 1200)

def create_pipe():
    random_pipe_pos = random.randint(200, 400)
    bottom_pipe = pygame.Rect(WIDTH, random_pipe_pos, pipe_width, pipe_height)
    top_pipe = pygame.Rect(WIDTH, random_pipe_pos - pipe_gap - pipe_height, pipe_width, pipe_height)
    return bottom_pipe, top_pipe

def move_pipes(pipes):
    for pipe in pipes:
        pipe.centerx -= 4
    return [pipe for pipe in pipes if pipe.right > -50]

def draw_pipes(pipes):
    for pipe in pipes:
        pygame.draw.rect(screen, GREEN, pipe)

def check_collision(pipes):
    for pipe in pipes:
        if bird.colliderect(pipe):
            return False
    if bird.top <= 0 or bird.bottom >= HEIGHT:
        return False
    return True

def display_score(state):
    if state == "main_game":
        score_surface = game_font.render(str(int(score)), True, WHITE)
        score_rect = score_surface.get_rect(center=(WIDTH//2, 50))
        screen.blit(score_surface, score_rect)
    if state == "game_over":
        score_surface = game_font.render(f"Score: {int(score)}", True, WHITE)
        score_rect = score_surface.get_rect(center=(WIDTH//2, 50))
        screen.blit(score_surface, score_rect)

        high_score_surface = game_font.render(f"High Score: {int(high_score)}", True, WHITE)
        high_score_rect = high_score_surface.get_rect(center=(WIDTH//2, 100))
        screen.blit(high_score_surface, high_score_rect)

# Game loop
clock = pygame.time.Clock()
while True:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            pygame.quit()
            sys.exit()

        if event.type == pygame.KEYDOWN:
            if event.key == pygame.K_SPACE and game_active:
                bird_movement = 0
                bird_movement -= 8
            if event.key == pygame.K_SPACE and not game_active:
                game_active = True
                pipe_list.clear()
                bird.center = (WIDTH//4, HEIGHT//2)
                bird_movement = 0
                score = 0

        if event.type == SPAWNPIPE:
            pipe_list.extend(create_pipe())

    screen.fill(BLUE)

    if game_active:
        # Bird
        bird_movement += gravity
        bird.centery += bird_movement
        pygame.draw.ellipse(screen, (255, 255, 0), bird)

        # Pipes
        pipe_list = move_pipes(pipe_list)
        draw_pipes(pipe_list)

        # Collision
        game_active = check_collision(pipe_list)

        # Scoring
        for pipe in pipe_list:
            if pipe.centerx == bird.centerx:
                score += 0.5  # Add 0.5 twice (for top and bottom pipe)
        display_score("main_game")
    else:
        if score > high_score:
            high_score = score
        display_score("game_over")

    pygame.display.update()
    clock.tick(60)
