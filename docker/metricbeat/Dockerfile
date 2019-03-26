FROM docker.elastic.co/beats/metricbeat:6.6.2
COPY metricbeat.yml /usr/share/metricbeat/metricbeat.yml
USER root
RUN chown root:metricbeat /usr/share/metricbeat/metricbeat.yml
RUN if [ -e /var/run/docker.sock ]; then sudo chown root:metricbeat /var/run/docker.sock; fi
USER metricbeat