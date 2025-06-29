## Próbka kodu:

### Zrealizowane funkcjonalności:

### Architektura
1. **DDD + SOLID** — podział na warstwy:
    - `Domain`: logika biznesowa, encje, interfejsy repozytoriów
    - `Application`: komendy, handler’y, DTO, listener’y, job’y
    - `Infrastructure`: implementacje np. Mail, repozytoriów, integracje
    - `UI`: kontrolery, middleware, FormRequesty
2. **CQRS** — rozdzielenie logiki:
    - `QueryHandlers` — odczyt danych
    - `CommandHandlers` — zapis danych i akcje modyfikujące

### Testowanie
3. **Testy jednostkowe**:
    - 2 testy dla handlerów: `CreateEventHandler`, `ListFiltredEventsHandler`

### Obsługa danych
4. **Filtrowanie eventów**:
    - po tytule, dacie rozpoczęcia, nazwie autora (`whereHas`)
    - obsługa przez `SearchEventRequest` + warstwa `Handler`

### Asynchroniczne akcje
5. **Queue i EventListener**:
    - po utworzeniu eventu wysyłany jest `EventCreated`
    - listener
    - użycie `Mail::to(...)->send(...)`
    - zapis do tabeli `jobs`

### Uwierzytelnianie i middleware
6. **Sanctum Auth API**:
    - Rejestracja, logowanie
    - Obsługa ról użytkownika
7. **Middleware JSON Accept Header**:
    - wymuszanie `Accept: application/json` na endpointach API
    - dzięki temu walidacja zwraca JSON-y nawet bez nagłówków od klienta

### Walidacja i DTO
8. **FormRequest + Enum**
