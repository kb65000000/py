from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/run_python')
def run_python():
    # Execute your Python code here.

    import pygame
    import random

    # Initialize Pygame
    pygame.init()

    # Set up the screen
    screen_width = 800
    screen_height = 600
    screen = pygame.display.set_mode((screen_width, screen_height))
    pygame.display.set_caption("Dodger Game")

    # Colors
    WHITE = (255, 255, 255)
    RED = (255, 0, 0)

    # Player
    player_width = 50
    player_height = 50
    player_x = (screen_width - player_width) // 2
    player_y = screen_height - player_height
    player_speed = 5

    # Obstacles
    obstacle_width = 50
    obstacle_height = 50
    obstacle_speed = 5

    def draw_player(x, y):
        pygame.draw.rect(screen, WHITE, (x, y, player_width, player_height))

    def draw_obstacle(x, y):
        pygame.draw.rect(screen, RED, (x, y, obstacle_width, obstacle_height))

    def collision(player_x, player_y, obstacle_x, obstacle_y):
        if (player_x < obstacle_x + obstacle_width and
                player_x + player_width > obstacle_x and
                player_y < obstacle_y + obstacle_height and
                player_y + player_height > obstacle_y):
            return True
        return False

    clock = pygame.time.Clock()

    # Game loop
    running = True
    score = 0
    obstacles = []

    while running:
        screen.fill((0, 0, 0))

        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                running = False

        keys = pygame.key.get_pressed()
        if keys[pygame.K_LEFT] and player_x > 0:
            player_x -= player_speed
        if keys[pygame.K_RIGHT] and player_x < screen_width - player_width:
            player_x += player_speed

        # Generate obstacles
        if random.randint(1, 100) < 10:
            obstacle_x = random.randint(0, screen_width - obstacle_width)
            obstacle_y = -obstacle_height
            obstacles.append([obstacle_x, obstacle_y])

        # Move and draw obstacles
        for obstacle in obstacles:
            obstacle[1] += obstacle_speed
            draw_obstacle(obstacle[0], obstacle[1])

            if collision(player_x, player_y, obstacle[0], obstacle[1]):
                running = False

            if obstacle[1] > screen_height:
                obstacles.remove(obstacle)
                score += 1

        draw_player(player_x, player_y)

        pygame.display.update()
        clock.tick(60)

    pygame.quit()

    print("Game Over")
    print("Your Score:", score)

    result = "Hello from Python!"
    return result

if __name__ == '__main__':
    app.run(debug=True)


