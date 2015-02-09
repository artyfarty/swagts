declare module TestClasses {
  export interface EventsResponse {
    total: number;

    values: Event[];

  }

  export interface Event {
    id: number; // Уникальный номер события

    created_at: string; // Дата создания события

    starts_at: string; // Дата начала события

    ends_at: string; // Дата конца события

    name: string; // Название события

    description_short: string; // Короткое описание события или подзаголовок

    description_html: string; // Полное описание события

    url: string; // Адрес события в timepad

    poster_image: Image; // Картинка события

    ad_partner_percent: number; // Процент, который получают партнёры за продажу билета на это событие

    locale: string; // Язык события по умолчанию

    location: Location; // Место проведения события

    organization: Organization; // Организация, проводящая событие

    categories: Category[]; // Категории события

    ticket_offers: TicketType; // Доступные типы билетов

    questions: Question[]; // Вопросы, задающиеся при регистрации

    widgets: Widget[]; // Виджеты, доступные для события

    properties: string[]; // Список особенностей события

    moderation_status: string; // Статус модерации

    registration_data: RegistrationData; // Обобщённые данные о билетах

  }

  export interface Image {
    default_url: string; // Картинка стандартного размера

    uploadcare_url: string; // Адрес картинки на uploadcare, к которому можно прибавлять запросы в формате uploadcare

  }

  export interface Location {
    country: string; // Название страны

    city: string; // Название города

    address: string; // Адрес проведения события

    coordinates: number[]; // Широта и долгота для карт

  }

  export interface Organization {
    id: number; // Уникальный номер организации

    name: string; // Название организации

    description_html: string; // Описание организации

    url: string; // URL организации на сайте

    logo_image: string; // Логотип

    id_string: string; // Уникальное название организации - часть URL

  }

  export interface Category {
    id: number; // Уникальный номер категории

    name: string; // Название категории

  }

  export interface TicketType {
    id: number; // Уникальный номер типа билета

    name: string; // Название типа билета

    buy_amount_min: number; // Минимальное количество билетов в одной покупке

    buy_amount_max: number; // Максимальное количество билетов в одной покупке

    price: number; // Цена билета

    is_promocode_locked: boolean; // Закрыт ли этот тип введённым промокодом

    remaining: number; // Сколько билетов осталось

    sale_ends_at: string; // Дата окончания продажи этого типа билета

  }

  export interface Question {
    id: number; // Уникальный номер вопроса

    name: string; // Текст вопроса

    type: string; // Тип вопроса

    possible_answers: Answer[]; // Список предлагаемых ответов (если вопрос предполагает такой список)

    is_mandatory: boolean; // На вопрос обязательно отвечать

    meta: Meta; // Дополнительные данные

  }

  export interface Widget {
    code_html: string; // Код вставки виджета в сайт

    type: string; // Код вставки виджета в сайт

  }

  export interface RegistrationData {
    price_max: number; // Цена самого дорогого билета

    price_min: number; // Цена самого дешёвого билета

    sale_ends_at: string; // Дата окончания продажи последней категории билета

    sold_quantity: number; // Количество продванных билетов

    ticket_limit_total: number; // Количество доступных билетов

    is_registration_open: boolean; // Открыта ли регистрация

  }

  export interface Answer {
    id: number; // Уникальный номер ответа

    name: string; // Текст ответа

  }

}