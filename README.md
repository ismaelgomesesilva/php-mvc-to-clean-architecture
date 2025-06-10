# Refactoring a PHP MVC System to Clean Architecture

This repository aims to demonstrate the refactoring of a traditional PHP application based on the MVC pattern into the Clean Architecture model, focusing on code organization, decoupling of responsibilities, and ease of maintenance.

## 🧠 Purpose

The goal of this project is to serve as a practical study of Clean Architecture applied to legacy PHP projects and also as a technical portfolio, demonstrating the ability to refactor existing code into a modern and sustainable standard.

## 💡 What is Clean Architecture?

Clean Architecture, proposed by Robert C. Martin (Uncle Bob), seeks to organize code so that the business logic (domain rules) is isolated from frameworks, databases, user interfaces, or any external technologies.

## 🔄 Refactoring Steps

This repository showcases the step-by-step transformation:

1. 📦 Original code based on traditional MVC.
2. 🔍 Identification of tightly coupled dependencies.
3. 🧩 Separation of layers:
   - Domain (Entities, Business Rules)
   - Use Cases (Application)
   - Interface Adapters (Controllers, Views, Gateways)
   - Frameworks & Drivers (Infrastructure, Database, External Frameworks)
4. 🧪 Introduction of automated tests.
5. 💬 Documentation of architectural decisions.

## 📁 Final Directory Structure

```
/src
  /Domain
    /Entities
    /Repositories
  /Application
    /UseCases
  /Infrastructure
    /Persistence
    /Framework
  /Interface
    /Controllers
    /Views
/public
/tests
```

## 🚀 Technologies Used

- PHP 8+
- Composer
- PHPUnit
- (Optional) Slim Framework or Laravel (only in the outer layer)

## 🧪 Tests

Tests are implemented with a focus on business rules (domain layer) and use cases. External layers (such as controllers and views) are tested only when necessary.

```bash
composer install
./vendor/bin/phpunit
```

## 📚 References

- [The Clean Architecture - Uncle Bob](https://8thlight.com/blog/uncle-bob/2012/08/13/the-clean-architecture.html)
- [PHP Clean Architecture Example - Carlos Buenosvinos](https://github.com/carlosbuenosvinos/hexagonal-architecture)
- [Domain-Driven Design - Eric Evans](https://domainlanguage.com)

## 🙋‍♂️ About the Author

My name is Ismael Silva, I’m a PHP developer with over 16 years of experience. I created this project to learn, practice, and share knowledge with the community, as well as to demonstrate my technical skills to recruiters.

---

⭐ **Feel free to clone, study, or contribute!**