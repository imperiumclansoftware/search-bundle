# Imperium Clan Software - Search Bundle

Unified search for symfony

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
composer require ics/search-bundle
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require ics/search-bundle
```

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    ICS\SearchBundle\SearchBundle::class => ['all' => true],
];
```

## Configuration

### Routing

Add this lines to `config/routes.yaml`

```yaml
search_bundle:
  resource: '@SearchBundle/config/routes.yaml'
  prefix: /search
```

## Usage

### Integrate an entity to the global search 

#### 1- Implements Interface `EntitySearchInterface` in your entity.

```php
# src/Entity/User.php

use ICS\SearchBundle\Entity\EntitySearchInterface;

class User implements EntitySearchInterface
{
    // Define name show in search results interface
    public static function getEntityClearName(): string
    {
        return "Application User";
    }
    // Define Template of the results
    public static function getSearchTwigTemplate(): string
    {
        return "search/result.html.twig";
    }
    // Define ROLES have access to the results
    public static function getRolesSearchEnabled(): array
    {
        return [
            'ROLE_ADMIN'
        ];
    }

}
```

#### 2- Implements Interface `EntitySearchRepositoryInterface` in the entity repository

```php

# src/Repository/UserRepository.php

use ICS\SearchBundle\Entity\EntitySearchRepositoryInterface;

class UserRepository extends ServiceEntityRepository implements EntitySearchRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    
    public function search(string $search) : ?Collection
    {
        $results = $this->createQueryBuilder('u')
            ->where('lower(u.name) LIKE lower(:search)')
            ->orWhere('lower(u.surname) LIKE lower(:search)')
            ->setParameter('search', "%".$search."%")
            ->orderBy('u.name', 'ASC')
            ->getQuery()
            ->getResult();
            dump($results);
        return new ArrayCollection($results);
    }
  
}
```

#### 3- Define HTML Twig for the entity search result

Each result entity are in `result` variable.
The user search word are in `search` variable.

```twig
{# templates/search/result.html.twig #}

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            {% if result.avatar %}
                <img src="{{ result.avatar.thumbnails["mediaBundleMini"] }}" class="img-fluid rounded-start" alt="...">
            {% endif %}
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="btn-group float-end">
                    <a class="btn btn-warning btn-sm" href="{{ path('user-edit',{user: result.id}) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
                <h5 class="card-title">{{ hightlight(result,search) }}</h5>
                <div class="text-muted">Gallery : {{ result.gallery|length }} elements</div>
            </div>
        </div>
    </div>
</div>
```

For help to highlight return a twig function are implemented to use this feature make search fields in function argument.

```twig

    {# Highlight property ## name ## of result from ## search ## #}

    {{ hightlight(result.name,search) }}

    {# You can personalise the class of highlight #}
    
    {{ hightlight(result.name,search,'bg-success text-light') }}

```