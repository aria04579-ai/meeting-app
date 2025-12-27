# Meeting App – Project Documentation

**Purpose of desgin this system**



This project is a PHP-based application that uses Docker and demonstrates:

Load balancing with HAProxy

Monitoring with Prometheus

Visualization with Grafana

## Structure of our project
```text
meeting-app/
├── app/
├── docker/
├── env/
├── grafana/
├── haproxy/
├── prometheus/
├── docker-compose.yml
└── Report.md

```


# app/ Directory (Core PHP Application)
## index.php

**Application entry point**

- Handles incoming HTTP requests

- Displays the main page, meeting information, or a countdown timer

- Runs on every backend instance behind HAProxy

## helpers.php

- Helper / utility functions

- Includes shared logic such as:

- Calculating remaining meeting time

- Formatting date and time

## metrics.php

### Critical for Prometheus monitoring

- Exposes a /metrics endpoint

- Outputs metrics in Prometheus-compatible format

- Example metrics:

- Total HTTP requests

- Prometheus scrapes this endpoint periodically.

## haproxy/ Directory

### HAProxy configuration file:

- frontend for incoming traffic

- backend for multiple PHP containers

- Load balancing algorithm ( roundrobin)


## prometheus/ Directory
### prometheus.yml

- Prometheus configuration:

- Defines scrape jobs

- Sets targets and endpoints

- Scrapes /metrics from PHP services


### Expected Output
| Service | URL |
|----|----|
| Prometheus | http://localhost:9090 |
| app | http://localhost:8000/metrics |
| Grafana | http://localhost:3000 |

## Running the Stack

```bash
docker compose up --build -d
```

Check containers:

```bash
docker ps
```



## Prometheus Verification

### Our Targets Page

```text
http://localhost:9090/targets
```

### Expected Output

- prometheus → UP





---

## Grafana Setup

### Login

```text
http://localhost:3000
```

- Username: admin
- Password: admin

### Add Prometheus Data Source

- Data Source → Prometheus
- URL: http://prometheus:9090

