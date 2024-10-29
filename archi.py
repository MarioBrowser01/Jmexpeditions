import webbrowser
import time
from googleapiclient.discovery import build

# Configuración de la API de YouTube
API_KEY = 'TU_API_KEY'  # Obtén tu clave API de YouTube
YOUTUBE_API_SERVICE_NAME = 'youtube'
YOUTUBE_API_VERSION = 'v3'

def get_top_song():
    youtube = build(YOUTUBE_API_SERVICE_NAME, YOUTUBE_API_VERSION, developerKey=API_KEY)
    request = youtube.search().list(
        part="snippet",
        maxResults=1,
        q="music",
        type="video",
        order="relevance"
    )
    response = request.execute()
    video_id = response['items'][0]['id']['videoId']
    return f"https://www.youtube.com/watch?v={video_id}"

def play_song():
    video_url = get_top_song()
    webbrowser.open(video_url)
    time.sleep(5)  # Espera para que cargue el navegador

play_song()
