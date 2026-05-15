drop function if exists public.factory_question(integer);

create or replace function public.factory_question(i integer)
returns table(
  index integer,
  content text,
  answer text,
  category text,
  lang varchar(2),
  on_site boolean,
  display boolean,
  created_at timestamptz
)
language sql
as $$
  select
    i,
    format('Question %s', i),
    format('Answer for question %s', i),
    (array['home', 'about', 'offer', 'services', 'other'])[(i % 5) + 1],
    (array['en', 'pl'])[(i % 2) + 1],
    (i % 2 = 0),
    (i % 3 <> 0),
    date_trunc('second', now() - ((i % 365) || ' days')::interval);
$$;

drop function if exists public.factory_technology(integer);

create or replace function public.factory_technology(i integer)
returns table(
  label text,
  description text,
  href text,
  src text,
  category text,
  display boolean,
  created_at timestamptz
)
language sql
as $$
  select
    format('Technology %s', i),
    format('Technology description %s', i),
    format('https://example.com/tech/%s', i),
    format('https://cdn.example.com/tech/%s.svg', i),
    (array['frontend', 'backend', 'devops'])[(i % 3) + 1],
    (i % 4 <> 0),
    date_trunc('second', now() - ((i % 365) || ' days')::interval);
$$;
